import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

//persisting states
import { uploadOfferPersist } from "./persist-state/persist";
import auth from "./auth/auth-store";
import uploadOffer from "./upload-offer/upload-offer";


const store = createStore({
    modules: {
        auth,
        uploadOffer
    },
    plugins: [
        createPersistedState(uploadOfferPersist),
    ],
});



export default store;
