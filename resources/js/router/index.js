import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/Home.vue";
import store from "../store";
// import MyListing from "../pages/admin/my-listing/MyListing";
// import Login from "../pages/Auth/Login";


const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    // used cars
    {
        path: "/usedCars",
        name: "usedCars",
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
        meta: { protected: true },
        component: () => import("../pages/sell-used-car/SellCar"),
        beforeEnter(to, from, next) {
            if (store.getters['auth/GET_AUTH_USER']) {
                next()
            } else {
                next({name: 'login'})
            }
        }
    },
    // {
    //     path: "/my-listing",
    //     name: "my-listing",
    //     component: MyListing,
    {
        path: "/login",
        name: "login",
        component: () => import('../pages/auth/Login'),
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
