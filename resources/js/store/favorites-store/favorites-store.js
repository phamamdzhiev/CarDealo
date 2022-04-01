export default {
    namespaced: true,
    state() {
        return {
            favorites: []
        }
    },
    mutations: {
        setFavorite(state, payload) {
            state.favorites.push(payload);
        },
        removeFavorite(state, payload){
            state.favorites.splice(payload, 1);
        },
        resetFilter(state) {
            state.favorites = [];
        }
    },
    getters: {
        getFavorite(state) {
            return state.favorites;
        }
    },
    actions: {},
}
