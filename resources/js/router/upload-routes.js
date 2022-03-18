import store from "../store";

export default [
    {
        path: "/upload",
        name: "upload",
        meta: {
            hideFooter: true,
            title: 'Качване на обява'
        },
        component: () => import("../pages/upload-offer/VehicleCategory"),
        beforeEnter(to, from, next) {
            if (store.getters['auth/GET_AUTH_USER']) {
                next()
            } else {
                next({name: 'login'})
            }
        }
    },
    {
        path: '/upload/:vehicleID',
        name: 'upload.vehicle',
        component: () => import('../pages/upload-offer/UploadOffer'),
        props: true,
        meta: {
            hideFooter: true,
            title: 'Качване на обява'
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
        path: '/upload/success',
        name: 'upload.success',
        component: () => import('../pages/upload-offer/Success'),
        meta: {
            hideFooter: true,
            title: 'Успешно качихте обява'
        },
        beforeEnter(to, from, next) {
            if (to.params.success) {
                next()
            } else {
                next({name: 'upload'})
            }
        }
    },
]
