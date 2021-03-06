/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue').default;
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '5px'
})

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.component('pagination', require('laravel-vue-pagination'));




let routes = [
  // { path: '/dashboard', component: require('../components/Dashboard.vue').default },
  { path: '/dashboard/users', component: require('../components/Users.vue').default },
  { path: '/dashboard/categories', component: require('../components/Categories.vue').default },
  { path: '/dashboard/books', component: require('../components/Books.vue').default },
  { path: '/dashboard/comments', component: require('../components/Comments.vue').default }
  // ,
  // { path: '/invoice', component: require('./components/Invoice.vue').default },
  // { path: '*', component: require('./components/NotFound.vue').default }
]


const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('../components/ExampleComponent.vue').default);




// make filters global
Vue.filter('upperCase', function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1)
});



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
     router,
});
