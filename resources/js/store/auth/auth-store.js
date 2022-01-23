export default {
    namespaced: true,
    state() {
        return {
            hasUserAuth: false,
        }
    },
    mutations: {
        SET_USER_AUTH(state) {
            state.hasUserAuth = true;
        }
    },
    getters: {
        HAS_USER_AUTH(state) {
            console.log('getter')
            return state.hasUserAuth;
        }
    },
    actions: {
        SET_USER_AUTH_ASYNC(context) {
            context.commit('SET_USER_AUTH');
        }
    },
}
