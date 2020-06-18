<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/todo','TodoController@index')->name('todo');
Route::post('/todo/add','TodoController@store');
Route::post('/todo/del','TodoController@delete');
Route::get('/todo/update-status','TodoController@updateStatus');


Route::post('todolist/add','TodoListController@store');
Route::post('todolist/del','TodoListController@delete');

