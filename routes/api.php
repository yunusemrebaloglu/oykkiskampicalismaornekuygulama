<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
// 	return $request->user();
// });

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

	Route::post('login', 'API\AuthController@login');
	Route::post('logout', 'API\AuthController@logout');
	Route::post('refresh', 'API\AuthController@refresh');
	Route::get('me', 'API\AuthController@me');

});
// Route::post('register', 'API\UserController@register');
Route::get('/', 'API\TodoItemController@index')->name("lolo")->middleware('auth:api');
Route::post('/store', 'API\TodoItemController@store')->name("storeTodo");
Route::put('/complaint/{todoitem}', 'API\TodoItemController@complaitedTodoList')->name('setComplaite')->middleware('auth:api');
Route::delete('/delete/{todoitem}', 'API\TodoItemController@deleteTodoList')->name('deleteItem')->middleware('auth:api');
