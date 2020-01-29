import router from './routes';

import store from './store';
const login = [''];
const todos = ['/todos'];
const loggedIn = store.state.token;
//

router.beforeEach((to, from, next) => {
	if ((!loggedIn && todos.includes(to.matched[0].path))) return next("/");
	if(loggedIn && login.includes(to.matched[0].path)) return next("/todos");
	next();
});
