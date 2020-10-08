/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('socialV-header', require('./components/includes/header.vue').default);
Vue.component('socialV-left', require('./components/includes/left.vue').default);
Vue.component('socialV-right', require('./components/includes/right.vue').default);
Vue.component('socialV-footer', require('./components/includes/footer').default);
Vue.component('socialv', require('./components/App.vue').default);



/*Routes*/
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
const routes = [
    { path: '/newsfeed', component: require('./components/socialV/NewsFeed').default},
    { path: '*', component: require('./components/socialV/errorPage/404.vue').default},
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})
/*end Routes*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */




const app = new Vue({
    el: '#app',
    router
});
