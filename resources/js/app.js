/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
require('/js/carousel/owl.carousel.js');

window.Vue = require('vue').default;

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
  // { path: '/dashboard', component: require('./components/Dashboard.vue').default },
  // { path: '/users', component: require('../components/Users.vue').default },
  { path: '/categories/:id', component: require('./components/pages/frontend/Category.vue').default },
  { path: '/category', component: require('./components/pages/frontend/Category.vue').default },
  // { path: '/books/{id}', component: require('./components/pages/frontend/Books.vue').default },
  // { path: '/comments', component: require('../components/Comments.vue').default }
  // ,
  // { path: '/invoice', component: require('./components/Invoice.vue').default },
  // { path: '*', component: require('./components/NotFound.vue').default }
]


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Home', require('./components/pages/frontend/Home.vue').default);
Vue.component('Navbar', require('./components/layouts/Navbar.vue').default);
Vue.component('Slider', require('./components/layouts/Slider.vue').default);
Vue.component('SliderProducts', require('./components/layouts/SliderProducts.vue').default);
Vue.component('FeaturePayment', require('./components/layouts/FeaturePayment.vue').default);
Vue.component('Testimonials', require('./components/layouts/Testimonials.vue').default);
Vue.component('AppFooter', require('./components/layouts/AppFooter.vue').default);
// pages
Vue.component('Category', require('./components/pages/frontend/Category.vue').default);
Vue.component('Cart', require('./components/pages/frontend/Cart.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});

$(document).ready(function()
{

    // page SliderProducts
    if($('.bbb_viewed_slider').length)
    {
        var viewedSlider = $('.bbb_viewed_slider');

        viewedSlider.owlCarousel(
        {
                loop:true,
                margin:30,
                autoplay:true,
                autoplayTimeout:6000,
                nav:false,
                dots:false,
                responsive:
            {
                0:{items:1},
                575:{items:2},
                768:{items:3},
                991:{items:4}
                // ,
                // 1199:{items:6}
            }
        });

        if($('.bbb_viewed_prev').length)
        {
            var prev = $('.bbb_viewed_prev');
            prev.on('click', function()
            {
                viewedSlider.trigger('prev.owl.carousel');
            });
        }

        if($('.bbb_viewed_next').length)
        {
        var next = $('.bbb_viewed_next');
            next.on('click', function()
            {
            viewedSlider.trigger('next.owl.carousel');
            });
        }
    }




// page Testimonials
if($('.slider_testimonial').length)
{
    var viewedSliderTestimonial = $('.slider_testimonial');

    viewedSliderTestimonial.owlCarousel(
    {
            loop:true,
            margin:30,
            autoplay:true,
            autoplayTimeout:4000,
            nav:false,
            dots:false,
            responsive:
            {
                0:{items:1},
                768:{items:2}
                // ,
                // 768:{items:3},
                // 991:{items:4},
                // 1199:{items:6}
            }
    });

}





});
