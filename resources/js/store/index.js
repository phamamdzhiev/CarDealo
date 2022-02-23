import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

//persisting states
import { uploadOfferPersist } from "./persist-state/persist";
import auth from "./auth/auth-store";
// import uploadOfferModule from "./upload-offer/upload-offer";
import cars from "./upload-offer/car";
import uploadOffer from "./upload-offer/upload-offer";


const store = createStore({
    modules: {
        auth,
        uploadOffer,
        // carOffer: cars
    },
    plugins: [
        createPersistedState(uploadOfferPersist),
        // createPersistedState(carOfferPersist)
    ],
});

// store.registerModule('car', carStore);


export default store;
