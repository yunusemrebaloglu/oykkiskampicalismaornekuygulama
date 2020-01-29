import Vue from 'vue';
import Login from '../components/Login.vue';
import Todos from '../components/Todos.vue';
import Logout from '../components/Logout.vue';

const routes = [
	{
		path: "/",
		component: Login
	},
	{
		path: "/todos",
		component: Todos
	},
	{
		path: "/logout",
		component: Logout
	}
];

export default routes
