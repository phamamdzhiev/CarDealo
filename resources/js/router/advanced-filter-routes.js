export default [
    {
        path: "/offers-showcase",
        name: "offers.showcase",
        meta: {
            title: 'Обяви'
        },
        component: () => import("../pages/advanced-search/OffersShowcase"),
    },
    {
        path: "/advanced-filters",
        name: "advanced.filters",
        meta: {
            title: 'Подробно търсене'
        },
        component: () => import("../pages/advanced-search/AdvancedFilters"),
    },
    {
        path: "/vehicle/:uid",
        name: "single-listing",
        component: () => import("../components/car/SingleListing"),
        props: true
    },
]
