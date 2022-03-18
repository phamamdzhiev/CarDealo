import store from "../store";

export default [
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
        path: "/listing/:uid/edit",
        name: "edit.listing",
        component: () => import('../pages/admin/my-listing/EditListing'),
        props: true,
        meta: {
            hideFooter: true,
            title: 'Редакция на обява'
        },
        beforeEnter(to, from, next) {
            if (store.getters['auth/GET_AUTH_USER']) {
                next()
            } else {
                next({name: 'login'})
            }
        }
    },
]
