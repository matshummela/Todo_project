<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\TodoList;
use App\Models\UserTodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $iUserId = Auth::id();
        $oTodoLists = TodoList::all();

        //统计未读数量
        $iMessageCount = Message::query()->where('user_id',$iUserId)
                                            ->where('is_read','0')
                                            ->count();
        //代办事项列表
        $oMyTodoLists = TodoList::query()->where('user_id',$iUserId)->get();

        //共享事项列表
        $aSharedTodoIds = UserTodoList::query()->where('user_id',$iUserId)
                                                ->where('status','2')
                                                ->pluck('todolist_id','todolist_id');
        $oSharedTodoLists = TodoList::query()->whereIn('id',$aSharedTodoIds)->get();
        return view('home',compact('oSharedTodoLists','oMyTodoLists','iMessageCount'));
    }
}
