import {createStore} from "vuex";
import createPersistedState from "vuex-persistedstate";

//persisting states
import {uploadOfferPersist, advancedFiltersPersist} from "./persist-state/persist";
import auth from "./auth/auth-store";
import uploadOffer from "./upload-offer/upload-offer";
import advancedFilters from "./advanced-search-store/advanced-search-store";


const store = createStore({
    modules: {
        auth,
        uploadOffer,
        advancedFilters

    },
    plugins: [
        createPersistedState(uploadOfferPersist),
        createPersistedState(advancedFiltersPersist),
    ],
});


export default store;
