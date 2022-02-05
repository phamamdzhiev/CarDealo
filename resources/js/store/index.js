import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

//persisting states
import { sellCarPersist, persistAuthUser } from "./persist-state/persist";
//store modules
import sellCar from "./sell-car/sell-car";
import auth from "./auth/auth-store";


const store = createStore({
    modules: {
        auth,
        sellCar
    },
    plugins: [
        createPersistedState(sellCarPersist),
        createPersistedState(persistAuthUser),
    ],
});



export default store;
