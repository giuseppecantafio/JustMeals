import Vue from 'vue'

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomeComponent from './pages/HomeComponent';
import SingleRestaurantComponent from './pages/SingleRestaurantComponent';

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/',
            name: '/home',
            component: HomeComponent,
        },
        {
            path: '/ristorantedaclelia',
            name: 'daclelia',
            component: SingleRestaurantComponent,
        }
    ]
});

export default router;