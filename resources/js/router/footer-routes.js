export default [
    {
        path: '/contacts',
        name: 'contacts',
        component: () => import('../pages/contacts/Contacts'),
        meta: {
            title: 'Контакти'
        },
    },
    {
        path: '/faq',
        name: 'faq',
        component: () => import('../pages/faq/FAQ'),
        meta: {
            title: 'Често задавани въпроси'
        },
    }
]
