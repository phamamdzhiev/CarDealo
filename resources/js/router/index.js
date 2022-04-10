import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/Home.vue";
//partial routes
import footerRoutes from "./footer-routes";
import uploadRoutes from "./upload-routes";
import authRoutes from "./auth-routes"
import profileRoutes from "./profile-routes";
import advancedFilterRoutes from "./advanced-filter-routes";
import merchantsRoutes from "./merchants-routes";

const routes = [
    ...footerRoutes,
    ...uploadRoutes,
    ...profileRoutes,
    ...authRoutes,
    ...advancedFilterRoutes,
    ...merchantsRoutes,
    {
        path: "/",
        name: "Home",
        meta: {
            title: 'Начало'
        },
        component: Home,
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
    // scrollBehavior(to, from, savedPosition) {
    //     if (savedPosition) {
    //         return savedPosition;
    //     } else {
    //         return {top: 0}
    //     }
    // },
    routes,
});

// NProgress.configure({showSpinner: true});
//
// router.beforeResolve((to, from, next) => {
//     // If this isn't an initial page load.
//     if (to.name) {
//         // Start the route progress bar.
//         NProgress.start()
//     }
//     next()
// })
//
// router.afterEach((to, from) => {
//     // Complete the animation of the route progress bar.
//     NProgress.done()
// })


export default router;
