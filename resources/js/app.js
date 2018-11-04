import './bootstrap';
import router from './routes';

Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

Vue.component('cheats-show', require('./components/CheatsShow.vue'));

const app = new Vue({
    el: '#app',
    router
});
