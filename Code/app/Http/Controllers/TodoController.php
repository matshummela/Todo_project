<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Todo;
use App\Models\TodoList;
use App\Models\UserTodoList;
use App\Services\TodoService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    protected $todoservice;

    public function __construct(TodoService $service)
    {
        $this->middleware('auth');
        $this->todoservice = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->input('status');
            $oTodos = Todo::query()->where('status', $status)
                ->where('todolist_id', $request->input('todolist_id'))
                ->orderBy('updated_at')->with('todolist')->get();
            $view = response(view('todo_child', compact('oTodos')))->getContent();
            return ['code' => 1, 'msg' => '成功', 'html' => $view];
        }
        $todolistId = $request->input('todolist_id');

        //判断用户是否为列表的所有者
        $iUserId = Auth::id();
        $aTodoList = TodoList::where('id',$todolistId)->first();
        $iAuthorId = $aTodoList['user_id'];
        //如果相等的话证明是作者本人,其他情况是共享用户，需要判断是否有修改权限
        $bAuthor = true;
        if ($iUserId == $iAuthorId){
            //获取所有接受共享请求的用户
            $oUserTodoLists = UserTodoList::query()->where('author_id', Auth::id())
                ->where('status', '2')
                ->where('todolist_id', $request->input('todolist_id'))
                ->get();
        }else{
            $bAuthor =false;
        }
        return view('todo', compact('todolistId', 'oUserTodoLists', 'bAuthor'));
    }

    //新增任务
    public function store(Request $request)
    {
        $iUserId = Auth::id();
        $iTodoListId = $request->input('todolist_id');
        $bUpdate = $this->todoservice->getUpdateRole($iTodoListId,$iUserId);
        if (!$bUpdate){
            return ['code' => 0, 'msg'=>'您没有权限进行修改，请联系作者添加权限'];
        }
        $todo = Todo::create([
            'user_id' => $iUserId,
            'todolist_id' =>$iTodoListId ,
            'content' => $request->input('content'),
        ]);
        return ['code' => 1, 'username' => Auth::user()->name,'todolist_name' =>$todo->todolist->name, 'id' => $todo->id];
    }

    //删除任务
    public function delete(Request $request)
    {
        $todo = Todo::query()->find($request->input('id'));
        $iTodoListId = $todo->todolist_id;
        $iUserId = Auth::id();
        $bUpdate = $this->todoservice->getUpdateRole($iTodoListId,$iUserId);
        if (!$bUpdate){
            return ['code' => 0, 'msg'=>'您没有权限进行修改，请联系作者添加权限'];
        }
        $todo->delete();
        return ['code' => 1];
    }

    //修改状态
    public function updateStatus(Request $request)
    {
        $todo = Todo::query()->find($request->input('id'));
        $iTodoListId = $todo->todolist_id;
        $iUserId = Auth::id();
        $bUpdate = $this->todoservice->getUpdateRole($iTodoListId,$iUserId);
        if (!$bUpdate){
            return ['code' => 0, 'msg'=>'您没有权限进行修改，请联系作者添加权限'];
        }
        $todo->status = 1;
        $todo->save();
        return ['code' => 1];
    }

    public function shareFriend()
    {
        return view('friend');
    }

    //更新用户权限
    public function updateFriendRole(Request $request)
    {
        $oUserTodoList = UserTodoList::query()->find($request->input('id'));
        $oUserTodoList->is_update = $request->input('is_update');
        $oUserTodoList->save();
        return ['code' => 1, 'real_update' => $oUserTodoList->real_update];
    }

    //删除分享用户
    public function delFriendRole(Request $request)
    {
        $oUserTodoList = UserTodoList::query()->where('id', $request->input('id'))->first();
        $user_id = $oUserTodoList['user_id'];
        $oUserTodoList->delete();
        Message::create([
            'userlist_id' => $oUserTodoList->id,
            'user_id' => $user_id,
            'message' => Auth::user()->name . "解除了与您进行共享---".$oUserTodoList->real_todo."---ToDo列表的请求",
            'is_auth' => '1',//表示无需进行操作
        ]);
        return ['code' => 1];
    }

    //共享ToDoList
    public function bindFriendTodo(Request $request)
    {
        $oUser = User::query()->where('name', $request->input('friend_name'))
            ->orWhere('email', $request->input('friend_name'))
            ->first();
        if (!$oUser) {
            return ['code' => 0, 'msg' => '您所要共享的好友不存在，请重新分享'];
        }
        $iTodoListId = $request->input('todolist_id');

        $aUserTodoList = UserTodoList::query()->where('user_id',$oUser->id)
                                                ->where('author_id',Auth::id())
                                                ->where('todolist_id',$iTodoListId)
                                                ->first();
        if (!empty($aUserTodoList)){
            return ['code' => 0, 'msg' => '您已经与好友共享了列表，请选择其他好友'];
        }

        $oUserTodoList = UserTodoList::query()->create([
            'user_id' => $oUser->id,
            'author_id' => Auth::id(),
            'todolist_id' =>$iTodoListId ,
            'is_update' => $request->input('status'),
        ]);

        //Log::info("sssss".$oUserTodoList->id);
        Message::create([
            'userlist_id' => $oUserTodoList->id,
            'user_id' => $oUser->id,
            'message' => Auth::user()->name . "邀请您共享---".$oUserTodoList->real_todo."---TODO列表"
        ]);
        return ['code' => 1];
    }

    //同意或者拒绝共享
    public function acceptOrNoTodo(Request $request)
    {
        $oUserTodoList = UserTodoList::query()->find($request->input('id'));
        $oUserTodoList->status = $request->input('status');
        $oUserTodoList->is_read = 1;
        $oUserTodoList->save();

        $oMessage = Message::query()->find($request->input('message_id'));
        $oMessage->is_read = '1';
        $oMessage->save();

        if ($oUserTodoList->status == '2') {
            $sMessage = "接受了共享---".$oUserTodoList->real_todo."---TODO列表的请求";
        } else {
            $sMessage = "拒绝了共享---".$oUserTodoList->real_todo."---TODO列表的请求";
        }
        Message::create([
            'userlist_id'=>$oUserTodoList->id,
            'user_id' => $oUserTodoList->author_id,
            'message' => Auth::user()->name . $sMessage,
            'is_auth' => '1',//表示无需进行操作
        ]);

        if ($oUserTodoList->status == '1'){
            $oUserTodoList->delete();
        }

        return ['code' => 1];

    }


}
