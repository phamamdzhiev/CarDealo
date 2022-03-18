import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/Home.vue";

//partial routes
import vehicleTypeRoutes from "./vehicle-catergory-routes";
import footerRoutes from "./footer-routes";
import uploadRoutes from "./upload-routes";
import authRoutes from "./auth-routes"
import profileRoutes from "./profile-routes";
import advancedFilterRoutes from "./advanced-filter-routes";
import merchantsRoutes from "./merchants-routes";

const routes = [
    ...vehicleTypeRoutes,
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
    routes,
});

export default router;
