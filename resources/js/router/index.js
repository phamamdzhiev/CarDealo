import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import UsedCars from "../pages/used-cars/UsedCars.vue";
import SellCar from "../pages/sell-used-car/SellCar";
import SellCarYear from "../pages/sell-used-car/SellCarYear";

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
        path: "/sell-car/year",
        name: "sell-car.year",
        component: SellCarYear,
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
