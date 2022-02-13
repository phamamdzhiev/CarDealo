import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/Home.vue";
import store from "../store";

const routes = [
    {
        path: "/",
        name: "Home",
        meta: {
            title: 'Начало'
        },
        component: Home,
    },
    {
        path: "/usedCars",
        name: "usedCars",
        meta: {
            title: 'Упоребявани автомобили'
        },
        component: () => import("../pages/used-cars/UsedCars.vue"),
    },
    {
        path: "/used-cars",
        name: "used-cars",
        component: () => import("../pages/advanced-search/AdvancedSearch"),
    },
    {
        path: "/car/:id",
        name: "single-listing",
        component: () => import("../components/car/SingleListing"),
        props: true
    },
    {
        path: "/sell-car",
        name: "sell.car",
        meta: {
            hideFooter: true,
            title: 'Качване на обява'
        },
        component: () => import("../pages/sell-used-car/SellCar"),
        beforeEnter(to, from, next) {
            if (store.getters['auth/GET_AUTH_USER']) {
                next()
            } else {
                next({name: 'login'})
            }
        }
    },
    {
        path: "/profile",
        name: "Profile",
        meta: {
            title: 'Профил',
        },
        component: () => import("../pages/admin/profile/Profile"),
        children: [
            {path: 'edit', name: 'Profile.edit', component: () => import('../pages/admin/profile/ProfileEdit'), meta: {title: 'Редакция на профил'}}
        ],
        beforeEnter(to, from, next) {
            if (store.getters['auth/GET_AUTH_USER']) {
                next()
            } else {
                next({name: 'login'})
            }
        }
    },
    {
        path: "/my-listing",
        name: "my.listing",
        component: () => import('../pages/admin/my-listing/MyListing'),
        meta: {
            hideFooter: true,
            title: 'Моите обяви'
        },
        beforeEnter(to, from, next) {
            if (store.getters['auth/GET_AUTH_USER']) {
                next()
            } else {
                next({name: 'login'})
            }
        }
    },
    {
        path: "/login",
        name: "login",
        component: () => import('../pages/auth/Login'),
        meta: {
            hideFooter: true,
            title: 'Вход / Регистрация'
        },
        beforeEnter(to, from, next) {
            if (!store.getters['auth/GET_AUTH_USER']) {
                next()
            } else {
                next({name: 'Home'})
            }
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import("../pages/404/NotFound")
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
