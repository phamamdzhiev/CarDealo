import {createStore} from "vuex";
import createPersistedState from "vuex-persistedstate";

//persisting states
import {uploadOfferPersist, advancedFiltersPersist, favoriteStorePersist} from "./persist-state/persist";
import auth from "./auth/auth-store";
import uploadOffer from "./upload-offer/upload-offer";
import advancedFilters from "./advanced-search-store/advanced-search-store";
import favoriteStore from "./favorites-store/favorites-store";
// import apicallstore from "./api-call-store";


const store = createStore({
    modules: {
        auth,
        uploadOffer,
        advancedFilters,
        favoriteStore,
        // apicallstore
    },
    plugins: [
        createPersistedState(uploadOfferPersist),
        createPersistedState(advancedFiltersPersist),
        createPersistedState(favoriteStorePersist),
    ],
});


export default store;
