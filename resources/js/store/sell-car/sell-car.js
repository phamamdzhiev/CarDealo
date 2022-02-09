import axios from 'axios';

export default {
    namespaced: true,
    state() {
        return {
            //helper data
            loading: false,
            step: 1,
            car_popular_brands: null,
            car_brand_with_models: null,
            selected_brand_id: null,
            selected_model_id: null,
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
                car_has_price: true,
                car_offer_city: null,
                car_offer_region: null,
                //step 7
                car_images: null, //array
            }
        }
    },
    mutations: {
        resetState(state) {
            Object.keys(state.car_offer).forEach((key) => {
                state.car_offer[key] = null;
            });

            Object.keys(state.car_extras).forEach((key) => {
               state.car_extras[key] = [];
            });

            state.car_offer['car_has_price'] = true;
            state.car_offer['new_or_used'] = 1;
            state.car_brand_with_models = null;
            state.selected_brand_id = null;
            state.selected_model_id = null;
        },
        setStepPlus(state) {
            state.step++
        },
        setStepMinus(state) {
            state.step--
        },
        setStepToOne(state) {
            state.step = 1
        },
        setPopularCarBrands(state, payload) {
            state.car_popular_brands = payload;
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
        setSelectedCarModelID(state, payload) {
            state.selected_model_id = payload;
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

        //offer title, desc, price
        SET_OFFER_TITLE(state, payload) {
            state.car_offer.car_offer_title = payload;
        },
        SET_OFFER_DESC(state, payload) {
            state.car_offer.car_offer_description = payload;
        },
        SET_CAR_PRICE(state, payload) {
            state.car_offer.car_price = payload;
        },
        SET_CAR_HAS_PRICE(state, payload) {
            state.car_offer.car_has_price = payload;
        },
        SET_OFFER_CITY(state, payload) {
            state.car_offer.car_offer_city = payload;
        },
        SET_OFFER_REGION(state, payload) {
            state.car_offer.car_offer_region = payload;
        },
        //Owner Details
        // SET_OWNER_NAME(state, payload) {
        //     state.car_offer.car_offer_owner.owner_name = payload;
        // },
        // SET_OWNER_EMAIL(state, payload) {
        //     state.owner_email = payload;
        // },
        // SET_OWNER_MOBILE(state, payload) {
        //     state.car_offer.car_offer_owner.owner_mobile = payload;
        // },
        // SET_OWNER_PASSWORD(state, payload) {
        //     state.owner_password= payload;
        // },
        SET_OWNER_STATUTE(state, payload) {
            state.car_offer.car_offer_owner.is_owner_business = payload;
        },
        // SET_OWNER_COMPANY_NAME(state, payload) {
        //     state.car_offer.car_offer_owner.owner_company = payload;
        // },
        // SET_OWNER_COMPANY_ADDRESS(state, payload) {
        //     state.car_offer.car_offer_owner.owner_company_address = payload;
        // },
        // SET_OWNER_COMPANY_EIK(state, payload) {
        //     state.car_offer.car_offer_owner.owner_company_eik = payload;
        // },
        // SET_OWNER_COMPANY_URL(state, payload) {
        //     state.car_offer.car_offer_owner.owner_company_url = payload;
        // },
        // setCarImages(state, payload) {
        //     state.car_offer.car_images = payload;
        // },
        // setCarDetails(state, payload) {
        //     state.car_offer.car_offer_title = payload.offerTitle;
        //     state.car_offer.car_offer_description = payload.offerDescription;
        //     state.car_offer.car_price = payload.offerPrice;
        // }
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        getStep(state) {
            return state.step;
        },
        getSelectedCarBrandID(state) {
            return state.selected_brand_id;
        },
        getCarPopularBrands(state) {
            return state.car_popular_brands;
        },
        getCarBrandWithModels(state) {
            return state.car_brand_with_models;
        },
        getCarExtrasApi(state) {
            return state.car_extras;
        },
        //getters for offer details
        GET_OFFER_TITLE(state) {
            return state.car_offer.car_offer_title;
        },
        GET_OFFER_DESC(state) {
            return state.car_offer.car_offer_description;
        },
        GET_CAR_PRICE(state) {
            return state.car_offer.car_price;
        },
        GET_CAR_OFFER_CITY(state) {
            return state.car_offer.car_offer_city;
        },
        GET_CAR_OFFER_REGION(state) {
            return state.car_offer.car_offer_region;
        },
        GET_CAR_HAS_PRICE(state) {
            return state.car_offer.car_has_price;
        },
        //getters for owner details
        IS_OWNER_BUSINESS(state) {
            return state.car_offer.car_offer_owner.is_owner_business;
        },
        // GET_OWNER_NAMES(state) {
        //     return state.car_offer.car_offer_owner.owner_name;
        // },
        GET_OWNER_EMAIL(state) {
            return state.owner_email;
        },
        // GET_OWNER_MOBILE(state) {
        //     return state.car_offer.car_offer_owner.owner_mobile;
        // },
        // GET_OWNER_PASSWORD(state) {
        //     return state.owner_password;
        // },
        // GET_OWNER_COMPANY_NAME(state) {
        //     return state.car_offer.car_offer_owner.owner_company;
        // },
        // GET_OWNER_COMPANY_ADDRESS(state) {
        //     return state.car_offer.car_offer_owner.owner_company_address;
        // },
        // GET_OWNER_COMPANY_EIK(state) {
        //     return state.car_offer.car_offer_owner.owner_company_eik;
        // },
        // GET_OWNER_COMPANY_URL(state) {
        //     return state.car_offer.car_offer_owner.owner_company_url;
        // },
        //get the final offer
        getAllData(state) {
            return state.car_offer;
        },
    },
    actions: {
        async setCarPopularBrands(context) {
            try {
                context.state.loading = true;
                const carPopularBrands = await axios.get('vehicle/fetch/popular-brands');
                context.state.loading = false;
                context.commit('setPopularCarBrands', carPopularBrands.data);
            } catch (e) {
                console.log('in popularCarBrands', e)
            }
        },

        async setCarBrandWithModels(context, id) {
            try {
                context.state.loading = true;
                const carBrandWithModels = await axios.get(`vehicle/fetch/car-models/${id}`);
                context.state.loading = false;
                context.commit('setCarMakeWithModels', carBrandWithModels.data);
            } catch (e) {
                console.log('in carBrandsWithModels', e)
            }
        },

        async setCarExtrasApi(context) {
            try {
                context.state.loading = true;
                const carExtras = await axios.get('vehicle/fetch/extras');
                context.state.loading = false;
                context.commit('setCarExtrasApi', carExtras.data);
            } catch (e) {
                console.log('in setCarExtras', e);
            }
        }
    }
}
