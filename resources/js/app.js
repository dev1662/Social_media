/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');
const { default: Echo } = require('laravel-echo');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('follow-button', require('./components/Followbutton.vue').default);

Vue.component('like-button', require('./components/LikeButton.vue').default);

Vue.component('notification', require('./components/Notify.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import axios from 'axios';
import { Button } from 'bootstrap';
const app = new Vue({
    el: '#app',
    data: {
        notifications: ''
        // likesn:''
        
    },
    created(){
        axios.get('/notification/get').then(response => {
           this.notifications = response.data
        });
        var userId = $('meta[name="userId"]').attr('content');
        window.Echo.private('App.User.' + userId).notification((notification) => {
            this.notifications.push(notification.data.id);
            console.log("app" + this.notifications);
            
        });
       
    },
    // created(){
    //     axios.get('/likenotify/get').then(response => {
    //        this.likesn = response.data
    //     });
    //     var userId = $('meta[name="userId"]').attr('content');
    //     window.Echo.private('App.User.' + userId).like-Button((likes) => {
    //         this.likesn.push(likes.data.id);
    //         console.log("app" + this.likes);
            
    //     });
       
    // },
  
    // {
    //     notifications: function () {
    //         return this
    //     }
    // }
});
