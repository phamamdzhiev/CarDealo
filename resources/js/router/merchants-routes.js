export default [
    {
        path: "/merchants",
        name: "Merchants",
        meta: {
            title: 'Автокъщи и дилъри'
        },
        component: () => import("../pages/merchants/Merchants"),
    },
    {
        path: "/merchant/:id",
        name: "Merchant.offers",
        props: true,
        meta: {
            title: 'Обяви на търговеца'
        },
        component: () => import("../pages/merchants/MerchantSingle"),
    }
]
