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
                year: null,
                extras: [],
                color: {
                    name: null,
                    id: null
                },
                transmission: {
                    name: null,
                    id: null
                },
                engine: {
                    name: null,
                    id: null
                },
                euroStandard: {
                    name: null,
                    id: null
                },
                hp: null,
                cm3: null,
                km: null,
                title: null,
                description: null,
                price:null,
                hasPrice: false,
                region: null,
                city: null
            }
        }
    },
    mutations: {
        resetVehicleState(state) {
            // Object.keys(state.vehicle).forEach((key) => {
            //     state.vehicle[key] = {name: null, id: null};
            // });
            //
            state.step = 1;
            state.vehicle.condition = 1;
            state.vehicle.year = null;
            state.vehicle.vehicleType = null;
            state.vehicle.vehicleCategory = null;
            state.vehicle.extras = [];
            state.vehiclehasPrice = 1;
        },
        setVehicleState(state, {key, value}) {
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
        isEmpty(state) {

        },
        getVehicleState(state) {
            return state.vehicle;
        },
        getStep(state) {
            return state.step
        }
    }
}
