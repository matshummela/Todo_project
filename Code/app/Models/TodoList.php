<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $table = 'todo_list';

    protected $fillable = ['name','user_id'];



}
