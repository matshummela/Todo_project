<?php
namespace App\Services;

use App\Models\TodoList;
use App\Models\UserTodoList;

class TodoService
{

    public function getUpdateRole($iTodolistId,$iUserId){
        $aTodoList = TodoList::query()->where('id',$iTodolistId)->first();
        $iAuthorId = $aTodoList['user_id'];
        if ($iAuthorId == $iUserId){
            $bUpdate = true;
        }else{
            $aUserTodoList = UserTodoList::query()->where('todolist_id',$iTodolistId)
                ->where('author_id',$iAuthorId)
                ->where('user_id',$iUserId)
                ->first();
            $bUpdate = (bool)$aUserTodoList['is_update'];
        }
        return $bUpdate;
    }
}
