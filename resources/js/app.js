
require('./bootstrap');

window.Vue = require('vue');

import store from './store';

import Vue from 'vue'
import VueRouter from 'vue-router'

import router from './routes';
import middleware from "./middleware.js";

import App from "./App.vue";


const app = new Vue({
	el: '#app',
	render: h => h(App),
	router,
	store
});
