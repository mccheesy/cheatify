import VueRouter from 'vue-router';

const routes = [
    {
        name: 'home',
        path: '/',
        component: require('./views/Home')
    },
    {
        name: 'cheats.index',
        path: '/cheats',
        component: require('./views/CheatsIndex')
    }
];

export default new VueRouter({ mode: 'history', routes });
