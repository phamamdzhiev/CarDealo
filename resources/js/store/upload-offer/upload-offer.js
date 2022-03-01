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
                price: null,
                hasPrice: false,
                region: null,
                city: null
            }
        }
    },
    mutations: {
        resetVehicleState(state) {
            state.vehicle.vehicleType = null;
            state.vehicle.vehicleCategory = null;
            state.vehicle.condition = 1;
            state.vehicle.brand = {name: null, id: null};
            state.vehicle.model = {name: null, id: null};
            state.vehicle.year = null;
            state.vehicle.extras = [];
            state.vehicle.color = {name: null, id: null};
            state.vehicle.transmission = {name: null, id: null};
            state.vehicle.engine = {name: null, id: null};
            state.vehicle.euroStandard = {name: null, id: null};
            state.vehicle.hp = null;
            state.vehicle.cm3 = null;
            state.vehicle.km = null;
            state.vehicle.title = null;
            state.vehicle.description = null;
            state.vehicle.price = null;
            state.vehicle.hasPrice = false;
            state.vehicle.region = null;
            state.vehicle.city = null;
            state.step = 1;
        },
        setVehicleState(state, {key, value}) {
            state.vehicle[key] = value;
        },
        setSelectedExtras(state, payload) {
            let index = state.vehicle.extras.findIndex(obj => obj.id === payload.id);
            index === -1 ? state.vehicle.extras.push(payload) : state.vehicle.extras.splice(index, 1);
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
        getVehicleState(state) {
            return state.vehicle;
        },
        getStep(state) {
            return state.step
        }
    }
}
