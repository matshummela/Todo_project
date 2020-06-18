<?php
namespace App\Http\Controllers;

use App\Models\TodoList;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $iUserId = Auth::id();
        TodoList::create([
            'name' => $request->input('list_name'),
            'user_id'=>$iUserId
        ]);
        return ['code'=>1];
    }

    public function delete(Request $request)
    {
        $oTodoList = TodoList::query()->find($request->input('id'));
        $oTodoList->delete();
        return ['code'=>1];
    }

}