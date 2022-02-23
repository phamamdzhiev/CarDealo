export default {
    namespaced: true,
    state() {
        return {
            step: 1,
            vehicle: {
                vehicleType: null,
                vehicleCategory: null,
                condition: 1,
                brand: {
                    name: null,
                    id: null
                },
                model: {
                    name: null,
                    id: null
                },
                year: null
            }
        }
    },
    mutations: {
        resetState(state) {
            Object.keys(state.vehicle).forEach((key) => {
                state.vehicle[key] = {name: null, id: null};
            });

            state.step = 1;
            state.vehicle.condition = 1;
            state.vehicle.year = null;
            state.vehicle.vehicleType = null
            state.vehicle.vehicleCategory = null
        },
        setState(state, {key, value}) {
            state.vehicle[key] = value;
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
        getState(state) {
            return state.vehicle;
        },
        getStep(state) {
            return state.step
        }
    }
}
