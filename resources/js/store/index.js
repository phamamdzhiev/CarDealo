import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

//persisting states
import { uploadOfferPersist } from "./persist-state/persist";
import auth from "./auth/auth-store";
// import uploadOfferModule from "./upload-offer/upload-offer";
import carStore from "./upload-offer/car";
import uploadOffer from "./upload-offer/upload-offer";


const store = createStore({
    modules: {
        auth,
        uploadOffer
    },
    plugins: [
        createPersistedState(uploadOfferPersist)
    ],
});

// store.registerModule('car', carStore);


export default store;
