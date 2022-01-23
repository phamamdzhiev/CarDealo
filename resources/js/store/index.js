import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
//modules
import sellCar from "./sell-car/sell-car";
import authStore from "./auth/auth-store";

const PersistSellCarState = createPersistedState({
    key: 'sellCar',
    paths: [
        'sellCar.car_offer',
        'sellCar.step',
        'sellCar.selected_brand_id',
        'sellCar.car_brand_with_models',
        'livesearch',
        'sellCar.owner_email'
    ],
    fetchBeforeUse: false,
    storage: window.sessionStorage
})

export default createStore({
    state: {
        hasUserAuth: false,
    },
    mutations: {
        SET_USER_AUTH(state) {
            state.hasUserAuth = true;
        }
    },
    getters: {
        HAS_USER_AUTH(state) {
            return state.hasUserAuth;
        }
    },
    actions: {
        SET_USER_AUTH_ASYNC(context) {
            context.commit('SET_USER_AUTH');
        }
    },
    modules: {
        sellCar: sellCar,
        authStore: authStore,
    },
    plugins: [PersistSellCarState],
})
