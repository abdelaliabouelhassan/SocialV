/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// Vue.config.debug = false;
// Vue.config.silent = true;
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
Vue.component('socialV-post', require('./components/socialV/NewsFeed/Posts').default);
Vue.component('socialv', require('./components/App.vue').default);
/*TimeagoVue*/

/*End TimeagoVue*/

/*Autocomplete*/
import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'
Vue.use(Autocomplete)

/*end Autocomplete*/

/*axios*/
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)

/*end axios*/

/*Read More*/
import ReadMore from 'vue-read-more';
Vue.use(ReadMore);

/*End Read More*/

/*VEmojiPicker*/
import VEmojiPicker from 'v-emoji-picker';
Vue.use(VEmojiPicker);
/*End VEmojiPicker*/


/*react */
import VueReact from 'vue-react';
Vue.use(VueReact);
import FbImageLibrary from 'react-fb-image-grid'
Vue.react('FbImageLibrary', FbImageLibrary);
/*end react*/

/*VueTypedJs*/
import VueTypedJs from 'vue-typed-js'
Vue.use(VueTypedJs)
/*End VueTypedJs*/

/*vue-infinite-loading  load more*/

import InfiniteLoading from 'vue-infinite-loading';

Vue.use(InfiniteLoading, { /* options */ });
/*end vue-infinite-loading load more*/

/*Routes*/
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import  routes from './routes/route'
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})
/*end Routes*/

/*Vuex*/
import store from './store/store'
/*End Vuex*/

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(106,203,255)',
    failedColor: 'red',
    height: '2px',
    thickness: '4px',
    transition: {
        speed: '1s',
        opacity: '1s',
        termination: 900
    },
})

/*Slideshow  image */
import PhotoGrid from 'vue-photo-grid';
Vue.use(PhotoGrid);
/*end Slideshow  image*/
/*sweetalert2*/
import Swal from 'sweetalert2'
window.Swal = Swal
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
})
window.swalWithBootstrapButtons = swalWithBootstrapButtons

const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-start',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast
/*end sweetalert2*/


/*emit*/
window.something = new Vue();
/*end emit*/
/*VTooltip*/
import VTooltip from 'v-tooltip'
Vue.use(VTooltip)
/*VTooltip*/

/*linkify for url display*/
import linkify from 'vue-linkify'

Vue.directive('linkified', linkify)
/*end linkify*/



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */




const app = new Vue({
    el: '#app',
    store,
    router
});
