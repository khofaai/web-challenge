import Routes from './routes.js';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
export const eventBus = new Vue();

import VueRouter from 'vue-router';
import Layout from './components/Layout.vue';

Vue.use(VueRouter);


Routes.beforeEach( (to, from, next) => {
	var Logged = localStorage.getItem('logged');

	if ( !to.meta.guest && !Logged ) {
		eventBus.$emit('logout');
		return next({path:'/login'});
	} else if(to.meta.guest && Logged) {
		
		return next({path:'/'});
	}
	return next();
});

const app = new Vue({
    el: '#app',
    router : Routes,
    render:h => h(Layout)
});
