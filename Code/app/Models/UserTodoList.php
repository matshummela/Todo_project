<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserTodoList extends Model
{
    protected $table = 'user_todolist';

    protected $guarded = [];



    public function getRealUpdateAttribute(){
        if ($this->is_update==1){
            return "允许编辑";
        }else{
            return "只读";
        }
    }

    public function getRealNameAttribute(){
        $oUser = User::query()->find($this->user_id);
        return $oUser->name;
    }

    public function getRealTodoAttribute(){
        $oTodoList = TodoList::query()->find($this->todolist_id);
        return $oTodoList->name;
    }







}
