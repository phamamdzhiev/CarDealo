export default [
    {
        path: "/advanced-search",
        name: "advanced.search",
        meta: {
            title: 'Разширено търсене'
        },
        component: () => import("../pages/advanced-search/AdvancedSearch"),
    },
    {
        path: "/advanced-filters",
        name: "advanced.filters",
        meta: {
            title: 'Подробно търсене'
        },
        component: () => import("../pages/advanced-search/AdvancedSearchNew"),
    },
    {
        path: "/vehicle/:uid",
        name: "single-listing",
        component: () => import("../components/car/SingleListing"),
        props: true
    },
]
