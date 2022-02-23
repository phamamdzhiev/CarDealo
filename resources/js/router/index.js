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
        meta: {
            title: 'Разширено търсене'
        },
        component: () => import("../pages/advanced-search/AdvancedSearch"),
    },
    {
        path: "/merchants",
        name: "Merchants",
        meta: {
            title: 'Автокъщи и дилъри'
        },
        component: () => import("../pages/merchants/Merchants"),
    },
    {
        path: "/car/:id",
        name: "single-listing",
        component: () => import("../components/car/SingleListing"),
        props: true
    },
    {
        path: "/upload",
        name: "upload",
        meta: {
            hideFooter: true,
            title: 'Качване на обява'
        },
        component: () => import("../pages/upload-offer/VehicleType")
        // beforeEnter(to, from, next) {
        //     if (store.getters['auth/GET_AUTH_USER']) {
        //         next()
        //     } else {
        //         next({name: 'login'})
        //     }
        // }
    },
    {
        path: '/upload/:vehicleID',
        name: 'upload.vehicle',
        component: () => import('../pages/upload-offer/UploadOffer'),
        props: true,
        meta: {
            hideFooter: true,
            title: 'Качване на обява'
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
            {
                path: 'edit',
                name: 'Profile.edit',
                component: () => import('../pages/admin/profile/ProfileEdit'),
                meta: {title: 'Редакция на профил'}
            },
            {
                path: 'chat',
                name: 'Chat',
                component: () => import('../pages/admin/chat/ChatMessages'),
                meta: {title: 'Съобщения'}
            }
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
        path: '/request/password',
        name: 'Request.password',
        component: () => import("../pages/auth/password-reset/RequestNewPassword"),
        meta: {
            hideFooter: true,
            title: 'Въстановяване на парола'
        },
        beforeEnter(to, from, next) {
            //basically route is protected and cannot be accessed if user is already logged in...
            if (store.getters['auth/GET_AUTH_USER']) {
                next({name: 'Profile'})
            } else {
                next();
            }
        }
    },
    {
        path: '/reset/password',
        name: 'Reset.password',
        component: () => import("../pages/auth/password-reset/ResetPassword"),
        meta: {
            hideFooter: true,
            title: 'Въстановяване на парола'
        },
        beforeEnter(to, from, next) {
            //basically route is protected and cannot be accessed if user is already logged in...
            if (store.getters['auth/GET_AUTH_USER']) {
                next({name: 'Profile'})
            } else {
                if (to.params.token && to.params.mobile) {
                    next();
                } else {
                    next({name: 'Request.password'})
                }
            }
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import("../pages/404/NotFound"),
        meta: {
            title: 'Не е намерена страница'
        },
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
