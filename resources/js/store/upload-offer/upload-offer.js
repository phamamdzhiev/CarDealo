export default {
    namespaced: true,
    state() {
        return {
            step: 1,
            vehicleType: null,
            vehicleCategory: null

        }
    },
    mutations: {
        setVehicleType(state, payload) {
            state.vehicleType = payload;
        },
        setVehicleCategory(state, payload) {
            return state.vehicleCategory = payload;
        },
        setStepPlus(state) {
            state.step++
        },
        setStepMinus(state) {
            if (state.step <= 1) {
                return;
            }
            state.step--
        },
    },
    getters: {
        getVehicleType(state) {
            return state.vehicleType;
        },
        getVehicleCategory(state) {
            return state.vehicleCategory;
        },
        getStep(state) {
            return state.step
        }
    }
}
