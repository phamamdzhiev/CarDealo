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
                transmission: null,
                engine: null,
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
                city: null,
                аxis: null,
                load: null,
                width: null,
                length: null,
                workingHours: null,
                wade: null,
                heating: null,
                wc: null,
                material: null,
                cooling: null,
                engineType: null,
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
            state.vehicle.transmission = null;
            state.vehicle.engine = null;
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
            state.vehicle.axis = null;
            state.vehicle.load = null;
            state.vehicle.width = null;
            state.vehicle.length = null;
            state.vehicle.workingHours = null;
            state.vehicle.wade = null;
            state.vehicle.heating = null;
            state.vehicle.wc = null;
            state.vehicle.material = null;
            state.vehicle.cooling = null;
            state.vehicle.engineType = null;
            state.step = 1;
        },
        setVehicleState(state, {key, value}) {
            state.vehicle[key] = value;
        },
        setSelectedExtras(state, payload) {
            state.vehicle.extras = payload;
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
