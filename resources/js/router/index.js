import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/Home.vue";
import UsedCars from "../pages/used-cars/UsedCars.vue";
import SellCar from "../pages/sell-used-car/SellCar";
import MyListing from "../pages/admin/my-listing/MyListing";
import Login from "../pages/Auth/Login";
import NotFound from "../pages/404/NotFound";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    // used cars
    {
        path: "/usedCars",
        name: "used-cars",
        component: UsedCars,
    },
    {
        path: "/sell-car",
        name: "sell.car",
        component: SellCar
    },
    {
        path: "/my-listing",
        name: "my-listing",
        component: MyListing,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
