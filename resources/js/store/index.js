import Vue from 'vue'
import Vuex from 'vuex'

import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

const store = new Vuex.Store({
	state: {
		token: null
	},
	mutations: {
		setToken(state, token) {
			state.token = token;
		},
	},
	plugins: [
		createPersistedState({
			paths: ["token"]
		})
	],
});

export default store
