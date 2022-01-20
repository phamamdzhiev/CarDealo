import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

const sellCarState = createPersistedState({
    key: 'sellCar',
    paths: ['sellCar.car_offer', 'sellCar.step', 'sellCar.selected_brand_id', 'sellCar.car_brand_with_models'],
    fetchBeforeUse: false,
    storage: window.sessionStorage
})
import sellCar from "./sell-car/sell-car";
export default createStore({
    state: {
    },
    mutations: {
    },
    actions: {
    },
    modules: {
        sellCar: sellCar
    },
    plugins: [sellCarState],
})
