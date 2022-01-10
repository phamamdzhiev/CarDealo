import axios from 'axios';

export default {
    namespaced: true,
    state() {
        return {
            //helper data
            loading: false,
            step: 1,
            car_brands: null,
            car_brand_with_models: null,
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
                new_or_used: null,
                car_brand: null,
                car_year: null,
                car_model: null,
                car_fuel: null,
                car_transmission: null,
                car_cm3:null,
                car_hp:null,
                car_km: null,
                car_extras: null, //array
                car_images: null, //array
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
                }
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
        setCarMake(state, payload) {
            state.car_offer.car_brand = payload
        },
        setCarYear(state, payload) {
            state.car_offer.car_year = payload;
        },
        setCarVariant(state, payload) {
            state.car_offer.car_fuel = payload.fuel;
            state.car_offer.car_transmission = payload.transmission;
            state.car_offer.car_cm3 = payload.cm3;
            state.car_offer.car_hp = payload.hp;
            state.car_offer.car_km = payload.km;
        },
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
                console.log('in setCarBrands',e)
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
