import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import UsedCars from "../pages/used-cars/UsedCars.vue";
import SellCar from "../pages/sell-used-car/SellCar";
import SellCarYear from "../pages/sell-used-car/SellCarYear";
import MyListing from "../pages/admin/my-listing/MyListing";
import Login from "../pages/Auth/Login";

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
        name: "sell-cars",
        component: SellCar,
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
    // {
    //     path: "/sell-car/model",
    //     name: "sell-car.model",
    //     component: SellCarModel,
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
