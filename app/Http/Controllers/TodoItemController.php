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

		if ($request->isComplaint == "true" ) $todoitem->whereNotNull("complated_at");
		elseif($request->isComplaint == "false") $todoitem->whereNull("complated_at");


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

	public function complaitedTodoList(TodoItem $todoitem)
	{
		// $todoitem->complated_at = Carbon::now();
		$todoitem->toggle();
		$todoitem->save();
		return redirect(route('lolo'));
	}
	public function deleteTodoList(TodoItem $todoitem)
	{
		$todoitem->delete();
		return redirect(route('lolo'));
	}

	public function randomAddTodo()
	{
		$todoItem = new TodoItem;
		$todoItem->text = rand();
		return $todoItem->save();
	}


}
