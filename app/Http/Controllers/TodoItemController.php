<?php

namespace App\Http\Controllers;

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

		$todoitem = $request->user()->todos()->orderBy($sortby, $sortType);

		if($request->searchColumnName) $todoitem->where($request->searchColumnName,'like', "%".$request->searchName."%");

		if ($request->isComplaint == "true" ) $todoitem->whereNotNull("completed_at");
		elseif($request->isComplaint == "false") $todoitem->whereNull("completed_at");


		return view("todos", ["todos" => $todoitem->paginate($request->paginateCount) ]);

	}

	public function store(Request $request)
	{
		$todoItem = new TodoItem;
		$todoItem->user_id = $request->user()->id;
		$todoItem->text = $request->text;
		$todoItem->save();
		return redirect(route('lolo'));
	}

	public function complaitedTodoList(TodoItem $todoitem, Request $request)
	{
		// $todoitem->completed_at = Carbon::now();
		if ($todoitem->user_id != $request->user()->id) abort(403);
		$todoitem->toggle();
		$todoitem->save();
		return redirect(route('lolo'));
	}

	public function deleteTodoList(TodoItem $todoitem, Request $request)
	{
		if ($todoitem->user_id != $request->user()->id) abort(403);
		$todoitem->delete();
		return redirect(route('lolo'));
	}



}
