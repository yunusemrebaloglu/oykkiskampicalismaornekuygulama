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
    return view('welcome');
});

Route::get('/falan' , function () {
	return App\TodoItem::all();
});

Route::get('/lolo', 'TodoItemController@index')->name("lolo");
Route::post('/store', 'TodoItemController@store')->name("storeTodo");
// Route::get('/random', 'TodoItemController@randomAddTodo');
Route::get('/complaint/{todoitem}', 'TodoItemController@complaitedTodoList')->name('setComplaite');
Route::get('/delete/{todoitem}', 'TodoItemController@deleteTodoList')->name('deleteItem');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
