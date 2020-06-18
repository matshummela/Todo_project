<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todo';

    protected $fillable = ['user_id','todolist_id','content','status'];

    public function todolist()
    {
        return $this->belongsTo(TodoList::class);
    }

    public function getUserNameAttribute(){
        $oUser = User::query()->find($this->user_id);
        return $oUser->name;
    }

}
