@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

				<form action="{{route('storeTodo')}}" method="post">
					@csrf
	<div class="input-group mb-3">
	  <input type="text" name="text" class="form-control" placeholder="New Todo Item" aria-label="New Todo Item" aria-describedby="button-addon2">
	  <div class="input-group-append">
	    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Button</button>
	  </div>
	</div>
				</form>
            <div class="card">
                <div class="card-header">TodoList</div>

				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Text</th>
							<th scope="col">Complate</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach($todos as $todo)
						<tr>
							<th scope="row">{{$todo->id}}</th>
							<td>{{$todo->text}}</td>
							<td>
								@if(!$todo->complated_at)

								<a href="{{route('setComplaite', $todo->id)}}">✅</a>
								@else
								<a href="{{route('setComplaite', $todo->id)}}">🕔</a>
								@endif
							</td>
							<td>
								<a href="{{route('deleteItem', $todo->id)}}">❌</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
