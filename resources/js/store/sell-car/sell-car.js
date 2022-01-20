import axios from 'axios';
import placeholder from "lodash/fp/placeholder";

export default {
    namespaced: true,
    state() {
        return {
            //helper data
            loading: false,
            step: 1,
            car_brands: null,
            car_brand_with_models: null,
            selected_brand_id: null,
            car_extras: {
                car_extra_1: [],
                car_extra_2: [],
                car_extra_3: [],
                car_extra_4: [],
                car_extra_5: [],
                car_extra_6: [],
            },
            //final offer
            car_offer: {
                //step 1
                new_or_used: 1,
                car_brand: null,
                //step 2
                car_year: null,
                //step 3
                car_model: null,
                //step 4
                car_fuel: null,
                car_transmission: null,
                car_cm3: null,
                car_hp: null,
                car_km: null,
                //step 5
                car_extras: null, //array
                car_color: null,
                car_category: null, // SUV, Cabriolet, Sedan etc..
                //step 6
                car_offer_title: null,
                car_offer_description: null,
                car_price: null,
                car_offer_owner: {
                    owner_name: null,
                    owner_email: null,
                    owner_mobile: null,
                    owner_company: null,
                    owner_company_eik: null,
                    owner_company_address: null,
                    owner_company_url: null,
                },
                //step 7
                car_images: null, //array
            }
        }
    },
    mutations: {
        // maybe better to make on Function SetStep(param) ;)
        setStepPlus(state) {
            state.step++
        },
        setStepMinus(state) {
            state.step--
        },
        setStepToOne(state) {
            state.step = 1
        },
        setAllCarMakes(state, payload) {
            state.car_brands = payload;
        },
        setCarMakeWithModels(state, payload) {
            state.car_brand_with_models = payload;
        },
        setNewOrUsed(state, payload) {
            state.car_offer.new_or_used = payload
        },
        setCarModel(state, payload) {
            state.car_offer.car_model = payload;
        },
        setCarBrand(state, payload) {
            state.car_offer.car_brand = payload
        },
        setSelectedCarBrandID(state, payload) {
            state.selected_brand_id = payload;
        },
        setCarYear(state, payload) {
            state.car_offer.car_year = payload;
        },
        setCarFuel(state, payload) {
            state.car_offer.car_fuel = payload;
        },
        setCarTransmission(state, payload) {
            state.car_offer.car_transmission = payload;
        },
        setCarCm3(state, payload) {
            state.car_offer.car_cm3 = payload;
        },
        setCarHp(state, payload) {
            state.car_offer.car_hp = payload;
        },
        setCarKm(state, payload) {
            state.car_offer.car_km = payload;
        },
        setCarVariant(state, payload) {
            state.car_offer.car_fuel = payload.fuel;
            state.car_offer.car_transmission = payload.transmission;
            state.car_offer.car_cm3 = payload.cm3;
            state.car_offer.car_hp = payload.hp;
            state.car_offer.car_km = payload.km;
        },
        //get all Car Extras from DB
        setCarExtrasApi(state, payload) {
            payload.forEach((item) => {
                if (item['extra_category'] === 1) {
                    state.car_extras.car_extra_1.push(item);
                } else if (item['extra_category'] === 4) {
                    state.car_extras.car_extra_4.push(item);
                }
            })
        },
        setCarExtras(state, payload) {
            state.car_offer.car_extras = payload;
        },
        setCarColor(state, payload) {
            state.car_offer.car_color = payload;
        },
        setCarCategory(state, payload) {
            state.car_offer.car_category = payload;
        },
        setCarImages(state, payload) {
            state.car_offer.car_images = payload;
        },
        setCarDetails(state, payload) {
            state.car_offer.car_offer_title = payload.offerTitle;
            state.car_offer.car_offer_description = payload.offerDescription;
            state.car_offer.car_price = payload.offerPrice;
        }
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        getStep(state) {
            return state.step
        },
        getSelectedCarBrandID(state) {
            return state.selected_brand_id;
        },
        getCarBrands(state) {
            return state.car_brands;
        },
        getCarBrandWithModels(state) {
            return state.car_brand_with_models;
        },
        getCarExtrasApi(state) {
            return state.car_extras;
        },
        //get the final offer
        getAllData(state) {
            return state.car_offer;
        },
    },
    actions: {
        async setCarBrands(context) {
            try {
                context.state.loading = true;
                const carBrands = await axios.get('api/get-car-brands');
                context.state.loading = false;
                context.commit('setAllCarMakes', carBrands.data['car_brands']);
            } catch (e) {
                console.log('in setCarBrands', e)
            }
        },

        async setCarBrandWithModels(context, id) {
            try {
                context.state.loading = true;
                const carBrandWithModels = await axios.get(`api/get-make-with-models/${id}`);
                context.state.loading = false;
                context.commit('setCarMakeWithModels', carBrandWithModels.data['car_brand_with_models']);
            } catch (e) {
                console.log('in carBrandsWithModels', e)
            }
        },

        async setCarExtrasApi(context) {
            try {
                context.state.loading = true;
                const carExtras = await axios.get('api/get-all-car-extras');
                context.state.loading = false;
                context.commit('setCarExtrasApi', carExtras.data['car_extras']);
            } catch (e) {
                console.log('in setCarExtras', e);
            }
        },

        //SEND ALL DATA TO THE SERVER
        async sendDataApi(_, payload) {

        }
    }
}
