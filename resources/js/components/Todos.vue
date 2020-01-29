<template>
	<div>
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<form @submit.prevent="addNewTodo" >
						<div class="input-group mb-3">
							<input type="text" v-model="textTodo" class="form-control" placeholder="New Todo Item" aria-label="New Todo Item" aria-describedby="button-addon2">
							<div class="input-group-append">
								<button class="btn btn-outline-primary" type="submit" id="button-addon2">Add</button>
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
								<tr v-for="(todo, key) in this.todos" :key="todo.id">
									<th scope="row">{{todo.id}}</th>
									<td>{{todo.text}}</td>
									<td @click="toggle(todo.id, key)">
										<span v-if="!todo.completed_at">🕔</span>
										<span v-else >✅</span>
									</td>
									<td @click="deleteTodo(todo.id,key)">
										<span >❌</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div
			:class="{'d-block':isLoading}"
			id="feedBackModalCenteredScrollable"
			class="modal fade show"
			tabindex="-1"
			role="dialog"
			aria-labelledby="feedBackModalCenteredScrollableTitle"
			aria-modal="true"
			style="background-color:rgba(0,0,0,.7);"
			>
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="">
						<img src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Forig11.deviantart.net%2F03d6%2Ff%2F2014%2F122%2F7%2Fa%2Floading_gif_by_zarzox-d7gwtxy.png&f=1&nofb=1" alt="loading">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</template>

<script>
export default {
	data() {
		return {
			textTodo:"",
			isLoading:false,
			todos: []
		};
	},
	methods: {
		toggle(id, key){
			this.isLoading=true;
			var self = this;
			axios.put("http://oyk.test/api/complaint/"+id)
			.then(function (response){
				self.todos[key].completed_at = response.data.completed_at
			})
			.catch(function(response){
				console.log(response);
			})
			.then(()=>{
				this.isLoading=false;
			});

		},
		getTodos(){
			this.isLoading=true;
			var self = this;
			axios.get("http://oyk.test/api/")
			.then(function (response){
				self.todos = response.data.data;
			})
			.catch(function(response){
				console.log(response);
			})
			.then(()=>{
				this.isLoading=false;
			});

		},
		deleteTodo(id, key){
			this.isLoading=true;
			var self = this;
			axios.delete("http://oyk.test/api/delete/"+id)
			.then(function (response){
				self.todos.splice(key,1);
			})
			.catch(function(response){
				console.log(response);
			})
			.then(()=>{
				this.isLoading=false;
			});

		},
		addNewTodo(){
			this.isLoading=true;
			var self = this;
			axios.post("http://oyk.test/api/store", {text : this.textTodo} )
			.then(function (response){
				self.todos.unshift(response.data);
			})
			.catch(function(response){
				console.log(response);
			})
			.then(()=>{
				this.textTodo = "";
				this.isLoading=false;
			});

		}

	},
	beforeMount() {
		console.log(this.$store.state.token);
		this.getTodos();
	}
}
</script>
