/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

let axios = require('axios');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


Vue.component('users-component', require('./components/UsersComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

// Register debounce directive
function debounce(fn, delay = 300) {
	var timeoutID = null;

	return function () {
		clearTimeout(timeoutID);

		var args = arguments;
		var that = this;

		timeoutID = setTimeout(function () {
			fn.apply(that, args);
		}, delay);
	}
};

Vue.directive('debounce', (el, binding) => {
	if (binding.value !== binding.oldValue) {
		// window.debounce is our global function what we defined at the very top!
		el.oninput = debounce(ev => {
			el.dispatchEvent(new Event('change'));
		}, parseInt(binding.value) || 300);
	}
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
