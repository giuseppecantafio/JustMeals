import Vue from 'vue'

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomeComponent from './pages/HomeComponent';
import RestaurantsComponent from './pages/RestaurantsComponent';
import MenuComponent from './pages/MenuComponent';
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
        },
        {
            path: '/restaurants',
            name: 'restaurants',
            component: RestaurantsComponent,
        },
        {
            path: '/restaurant/:slug',
            name: 'menu',
            component: MenuComponent,
        },
    ]
});

export default router;