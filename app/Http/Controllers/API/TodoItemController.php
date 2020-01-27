<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Auth;
use App\TodoItem;
use Illuminate\Http\Request;
use Carbon\Carbon;



class TodoItemController extends Controller
{
	public function index(Request $request)
	{
		$sortby = "id";
		$sortType = "DESC";
		if ($request->$sortby) $sortby = $request->$sortby  & $sortType = $request->sortType;

		$todoitem = Auth::guard('api')->user()->todos()->orderBy($sortby, $sortType);

		if($request->searchColumnName) $todoitem->where($request->searchColumnName,'like', "%".$request->searchName."%");

		if ($request->isComplaint == "true" ) $todoitem->whereNotNull("complated_at");
		elseif($request->isComplaint == "false") $todoitem->whereNull("complated_at");


		return $todoitem->paginate($request->paginateCount);

	}

	public function store(Request $request)
	{
		$todoItem = new TodoItem;
		$todoItem->user_id = Auth::guard('api')->user()->id;
		$todoItem->text = $request->text;
		$todoItem->save();
		return $todoItem;
	}

	public function complaitedTodoList(TodoItem $todoitem, Request $request)
	{
		// $todoitem->complated_at = Carbon::now();
		if ($todoitem->user_id != Auth::guard('api')->user()->id) abort(403);
		$todoitem->toggle();
		$todoitem->save();
		return $todoitem;
	}
	public function deleteTodoList(TodoItem $todoitem, Request $request)
	{
		if ($todoitem->user_id != Auth::guard('api')->user()->id) abort(403);
		$todoitem->delete();
		return response()->json(["message" => "silindi"],200);
	}



}
