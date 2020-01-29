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

// Auth::routes();
Route::any('{all}', function(){
	return view("vue");
})->where('all', '^((?!(api|broadcast)).)*');
// Route::view('vuetest', 'vuetest');
//
// Route::get('/', 'TodoItemController@index')->name("lolo")->middleware(['auth']);
// Route::post('/store', 'TodoItemController@store')->name("storeTodo")->middleware(['auth']);
// Route::get('/complaint/{todoitem}', 'TodoItemController@complaitedTodoList')->name('setComplaite')->middleware(['auth']);
// Route::get('/delete/{todoitem}', 'TodoItemController@deleteTodoList')->name('deleteItem')->middleware(['auth']);
//
//
// Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth']);
