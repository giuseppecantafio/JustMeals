import Vue from 'vue'

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomeComponent from './pages/HomeComponent';
import RestaurantsComponent from './pages/RestaurantsComponent';
import MenuComponent from './pages/MenuComponent';
import SingleRestaurantComponent from './pages/SingleRestaurantComponent';
import CartComponent from './partials/CartComponent';

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
        {
            path: '/cart',
            name: 'cart',
            component: CartComponent,
        },
    ]
});

export default router;