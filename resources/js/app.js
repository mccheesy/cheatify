import './bootstrap';
import router from './routes';

Vue.component('cheatify-navbar', require('./components/CheatifyNavbar.vue'));
Vue.component('cheat-show', require('./components/CheatShow.vue'));

Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

const app = new Vue({
    el: '#app',
    router
});
