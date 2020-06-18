<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\UserTodoList;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //查看所有未读通知
    public function notifyList(){
        $iUserId = Auth::id();
        $oMessage = Message::query()->where('user_id',$iUserId)
                                    ->orderBy('created_at','desc')
                                    ->get();
        //将数据标记为已读
        foreach ($oMessage as $message){
            if ($message->is_auth){
                $message->is_read = '1';
                $message->save();
            }
        }
        return view('notifylist',compact('oMessage'));
    }
}
