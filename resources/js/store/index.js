import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

//persisting states
import { sellCarPersist, persistAuthUser } from "./persist-state/persist";
//store modules
import sellCar from "./sell-car/sell-car";
import auth from "./auth/auth-store";


export default createStore({
    modules: {
        sellCar,
        auth
    },
    plugins: [
        createPersistedState(sellCarPersist),
        createPersistedState(persistAuthUser),
    ],
})
