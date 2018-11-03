import VueRouter from 'vue-router';

const routes = [
    {
        name: 'home',
        path: '/',
        component: require('./views/Home')
    },
    {
        name: 'cheat.index',
        path: '/cheats',
        component: require('./views/Cheats')
    }
];

export default new VueRouter({ mode: 'history', routes });
