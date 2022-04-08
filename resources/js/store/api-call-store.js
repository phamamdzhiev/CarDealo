export default {
    namespaced: true,
    state() {
        return {
            lazyLoadOffersShowcase: {},
        }
    },
    mutations: {
        setLazyLoadOffersShowcase(state, payload) {
            // state.lazyLoadOffersShowcase.push(...payload);
            state.lazyLoadOffersShowcase=payload;
        }
    },
    getters: {
        getLazyLoadOffersShowcase(state) {
            return state.lazyLoadOffersShowcase;
        }
    },
    actions: {},
}
