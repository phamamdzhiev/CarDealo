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
        path: "/vehicle/:uid",
        name: "single-listing",
        component: () => import("../components/car/SingleListing"),
        props: true
    },
]
