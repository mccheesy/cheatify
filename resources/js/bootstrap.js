import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import axios from 'axios';

window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(BootstrapVue);

const is_auth = document.head.querySelector('meta[name="is_auth"]');
const user = document.head.querySelector('meta[name="user"]');

window.is_auth = is_auth.content ? true : false;
window.user = user.content;

const token = document.head.querySelector('meta[name="csrf-token"]');

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}
