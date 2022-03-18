import store from "../store";

export default [
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
]
