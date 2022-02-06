// import Cookies from "js-cookie";

export const sellCarPersist = {
    key: 'sellCar',
    paths: [
        'sellCar.car_offer',
        'sellCar.step',
        'sellCar.selected_brand_id',
        'sellCar.car_brand_with_models',
    ],
    fetchBeforeUse: false,
    storage: window.sessionStorage
};
//
// export const persistAuthUser = {
//     key: 'auth',
//     paths: [
//         'auth.is_authenticated',
//         'auth.user'
//     ],
//     storage: window.sessionStorage
// storage: {
//     getItem: (key) => Cookies.get(key),
//     setItem: (key, value) => Cookies.set(key, value, {
//         expires: 1,
//         secure: true
//     }),
//     removeItem: (key) => Cookies.remove(key)
// }
// };
