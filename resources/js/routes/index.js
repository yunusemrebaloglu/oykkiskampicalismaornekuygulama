import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes.js';

Vue.use(VueRouter)



const router = new VueRouter({
	mode: 'history',
	routes
});


import store from '../store';
const login = ['/'];
const todos = ['/todos'];
const loggedIn = store.state.token;
//
	// console.log(to);

	// if ((!loggedIn && todos.includes(to.matched[0].path)) || (loggedIn && login.includes(to.matched[0].path))) return next("/");

export default router
