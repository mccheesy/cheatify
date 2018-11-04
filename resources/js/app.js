import './bootstrap';
import router from './routes';

Vue.component('cheatify-navbar', require('./components/CheatifyNavbar.vue'));
Vue.component('cheat-show', require('./components/CheatShow.vue'));

const app = new Vue({
    el: '#app',
    router
});
