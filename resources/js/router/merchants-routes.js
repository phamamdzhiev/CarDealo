export default [
    {
        path: "/merchants",
        name: "Merchants",
        meta: {
            title: 'Автокъщи и дилъри'
        },
        component: () => import("../pages/merchants/Merchants"),
    }
]
