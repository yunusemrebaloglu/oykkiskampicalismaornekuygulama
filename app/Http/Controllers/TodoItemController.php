<?php

namespace App\Http\Controllers;

use App\TodoItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TodoItemController extends Controller
{
    public function index(TodoItem $todoitem)
	{
		return view("todos", ["todos" => $todoitem->latest()->get() ]);
	}

	public function store(Request $request)
	{
		$todoItem = new TodoItem;
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
