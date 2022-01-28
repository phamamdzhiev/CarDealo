export default {
    namespaced: true,
    state() {
        return {
            user: false,
            is_authenticated: false
        }
    },
    mutations: {
        SET_USER_AUTH(state, payload) {
            state.user = payload;
            state.is_authenticated = !!payload;
        }
    },
    getters: {
        GET_AUTH_USER(state) {
            return state.user;
        },
        HAS_USER(state) {
            return state.is_authenticated;
        }
    },
    actions: {
        SET_USER_AUTH_ASYNC(context) {
            context.commit('SET_USER_AUTH');
        }
    },
}
