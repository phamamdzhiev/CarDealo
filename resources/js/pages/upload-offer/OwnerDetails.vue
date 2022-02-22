<template>
    <div class="sell-car">
        <base-card>
            <span @click="setStepMinus" class="back__button">Назад <i class="fw-light">(Стъпка 5)</i></span>
            <TopBar/>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Детайли по обявата?</h5>
                <div class="form-floating form-group">
                    <input type="text" class="form-control form__input"
                           placeholder="Заглавие на обявата"
                           id="floatingInputOfferTitle"
                           v-model.trim="offerTitle"
                    >
                    <label for="floatingInputOfferTitle">Заглавие на обявата</label>
                    <FromInputValidationMessage v-if="v$.offerTitle.$error"
                                                :messages="v$.offerTitle.$errors"/>
                </div>
                <div class="form-floating form-group text-area-wrapper">
                    <textarea class="form__input form-control" placeholder="Допълнителна информация"
                              id="floatingTextarea"
                              v-model.trim="offerDesc"
                    ></textarea>
                    <label for="floatingTextarea">Допълнителна информация</label>
                    <!--<small style="font-size: 13px; display:block" v-if="offerDesc.length"> {{ offerDesc.length }} /
                        5000</small>-->
                    <FromInputValidationMessage v-if="v$.offerDesc.$error"
                                                :messages="v$.offerDesc.$errors"/>
                </div>
                <div class="form-floating form-group" v-if="regions">
                    <select class="form__input form-select" id="floatingSelectRegion"
                            v-model.trim="offerRegion"
                            @change="fetchCity(offerRegion)"
                    >
                        <optgroup label="Област">
                            <option :value="region.id" v-for="region in regions" :key="region.id">
                                {{ region.name }}
                            </option>
                        </optgroup>
                    </select>
                    <label for="floatingSelectRegion">Моля изберете област</label>
                    <FromInputValidationMessage v-if="v$.offerRegion.$error"
                                                :messages="v$.offerRegion.$errors"/>
                </div>
                <div class="form-floating form-group" v-if="cities">
                    <select class="form__input form-select" id="floatingSelectCity"
                            v-model.trim="offerCity"
                    >
                        <optgroup label="Областен град" v-if="asCity.length > 0">
                            <option class="text-base-color fw-bold"
                                    :value="c.id" :key="c.id" v-for="c in asCity">ГР.
                                {{ c.city }}
                            </option>
                        </optgroup>
                        <optgroup>
                            <option :value="city.id" v-for="city in cities" :key="city.id">{{
                                    city.city
                                }}
                            </option>
                        </optgroup>

                    </select>
                    <label for="floatingSelectCity">Моля изберете населено място</label>
                    <FromInputValidationMessage v-if="v$.offerCity.$error"
                                                :messages="v$.offerCity.$errors"/>
                </div>
                <div class="form-floating form-group">
                    <input type="number" class="form-control form__input" id="floatingInputPrice"
                           placeholder="Цена (BGN)" :disabled="isFieldDisabled"
                           v-model.trim="offerPrice"
                    >
                    <label for="floatingInputPrice">Цена (BGN)</label>
                    <div class="mt-1 ms-1 negotiable-price">
                        <label for="negotiable-price" :class="{ checked: !GET_CAR_HAS_PRICE }">
                            <input type="checkbox" id="negotiable-price" v-show="false" @change="togglePrice"/>
                            По договаряне?
                        </label>
                    </div>
                    <FromInputValidationMessage v-if="v$.offerPrice.$error"
                                                :messages="v$.offerPrice.$errors"/>
                </div>
            </div>
            <!--            <div v-if="!getUser" :style="IS_OWNER_BUSINESS ? 'font-weight: bold' : 'font-weight: normal'"-->
            <!--                 class="d-flex justify-content-end align-items-center"-->
            <!--                 @click="toggleBusinessOffer"-->
            <!--                 style="cursor:pointer;user-select: none;max-width: max-content;margin: 0 0 0 auto;">-->
            <!--                Публикува Бизнес Обява?-->
            <!--                <span class="ms-2">-->
            <!--                    <svg v-show="!IS_OWNER_BUSINESS" xmlns="http://www.w3.org/2000/svg" width="28" height="28"-->
            <!--                         fill="currentColor" class="bi bi-toggle2-off" viewBox="0 0 16 16">-->
            <!--                      <path d="M9 11c.628-.836 1-1.874 1-3a4.978 4.978 0 0 0-1-3h4a3 3 0 1 1 0 6H9z"/>-->
            <!--                      <path d="M5 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1A5 5 0 1 0 5 3a5 5 0 0 0 0 10z"/>-->
            <!--                    </svg>-->
            <!--                    <svg v-show="IS_OWNER_BUSINESS" xmlns="http://www.w3.org/2000/svg" width="28" height="28"-->
            <!--                         fill="currentColor" class="bi bi-toggle2-on" viewBox="0 0 16 16">-->
            <!--                      <path-->
            <!--                          d="M7 5H3a3 3 0 0 0 0 6h4a4.995 4.995 0 0 1-.584-1H3a2 2 0 1 1 0-4h3.416c.156-.357.352-.692.584-1z"/>-->
            <!--                      <path d="M16 8A5 5 0 1 1 6 8a5 5 0 0 1 10 0z"/>-->
            <!--                    </svg>-->
            <!--                </span>-->
            <!--            </div>-->
            <!--            <div class="question-section" v-if="false">-->
            <!--                <h5 class="fw-bold">Детайли за фирмата?</h5>-->
            <!--                <div class="form-floating form-group">-->
            <!--                    <input type="text" class="form__input form-control" id="floatingInputCompany"-->
            <!--                           placeholder="Име на автокъщата"-->
            <!--                           v-model.trim="ownerCompanyName">-->
            <!--                    <label for="floatingInputCompany">Име на автокъщата</label>-->
            <!--                    <FromInputValidationMessage v-if="v$.ownerCompanyName.$error"-->
            <!--                                                :messages="v$.ownerCompanyName.$errors"/>-->
            <!--                </div>-->
            <!--                <div class="form-floating form-group">-->
            <!--                    <input type="text" class="form__input form-control" id="floatingInputBulstat"-->
            <!--                           placeholder="Булстат/ЕИК"-->
            <!--                           v-model.trim="ownerCompanyEik">-->
            <!--                    <label for="floatingInputBulstat">Булстат/ЕИК</label>-->
            <!--                    <FromInputValidationMessage v-if="v$.ownerCompanyEik.$error"-->
            <!--                                                :messages="v$.ownerCompanyEik.$errors"/>-->
            <!--                </div>-->
            <!--                <div class="form-floating form-group">-->
            <!--                    <input type="text" class="form__input form-control" id="floatingInputAddress"-->
            <!--                           placeholder="Адрес на автокъщата"-->
            <!--                           v-model.trim="ownerCompanyAddress">-->
            <!--                    <label for="floatingInputAddress">Адрес на автокъщата</label>-->
            <!--                    <FromInputValidationMessage v-if="v$.ownerCompanyAddress.$error"-->
            <!--                                                :messages="v$.ownerCompanyAddress.$errors"/>-->
            <!--                </div>-->
            <!--                <div class="form-floating form-group">-->
            <!--                    <input type="text" class="form__input form-control" id="floatingInputDomain"-->
            <!--                           placeholder="Личен домейн в CarDealo" v-model.trim="ownerCompanyURL">-->
            <!--                    <label for="floatingInputDomain">Личен домейн в {{ window.APP_NAME }}</label>-->
            <!--                </div>-->
            <!--            </div>-->
            <button @click="showLastStep" class="base-button">
                <span v-if="!isLoading">Качване на снимки</span>
                <loading-dots v-else></loading-dots>
            </button>
        </base-card>
        <!--        <button @click="showModal = true">Open Modal</button>-->
        <!--        <BaseModal v-if="showModal" @close-modal="showModal = false">-->
        <!--            <div class="form-group">-->
        <!--                <form @submit.prevent="">-->
        <!--                    <input type="text" placeholder="Въведете кода от емайла, който поличихте">-->
        <!--                    <button>Верифицирай</button>-->
        <!--                </form>-->
        <!--            </div>-->
        <!--        </BaseModal>-->
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import BaseModal from "../../components/ui/base/BaseModal";
import useVuelidate from '@vuelidate/core';
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import {required, maxLength, requiredIf, minValue, integer, helpers, maxValue} from '@vuelidate/validators'
import TopBar from "./TopBar";
import {mapGetters, mapMutations} from "vuex";
import axios from "axios";

export default {
    name: "OwnerDetails",
    inject: ['window'],
    components: {
        TopBar,
        BaseCard,
        BaseModal,
        FromInputValidationMessage
    },
    data() {
        return {
            v$: useVuelidate(),
            isLoading: false,
            hasPrice: false,
            regions: null,
            cities: null,
            asCity: []
        }
    },
    validations() {
        return {
            offerTitle: {
                required: helpers.withMessage('Заглавието е задължително', required)
            },
            offerDesc: {
                required: helpers.withMessage('Описанието е задължително', required),
                maxLength: helpers.withMessage('Описанието трябва да бъде до 5000 символа', maxLength(5000))
            },
            offerRegion: {
                required: helpers.withMessage('Областта е задължителна', required)
            },
            offerCity: {
                required: helpers.withMessage('Градът е задължителен', required)
            },
            offerPrice: {
                requiredIf: helpers.withMessage('Цената е задължителна', requiredIf(this.GET_CAR_HAS_PRICE)),
                minValue: helpers.withMessage('Минимална цена 1 лев', minValue(1)),
                maxValue: helpers.withMessage('Въведете реална цена', maxValue(9999999)),
                integer: helpers.withMessage('Ценета трябва да е цяло число', integer)
            }
            //business details optional
            // ownerCompanyName: {
            //     requiredIf: helpers.withMessage('Името на автокъщата задължително', requiredIf(this.IS_OWNER_BUSINESS))
            // },
            // ownerCompanyEik: {
            //     requiredIf: helpers.withMessage('ЕИК/Булстат е задължителен', requiredIf(this.IS_OWNER_BUSINESS))
            // },
            // ownerCompanyAddress: {
            //     requiredIf: helpers.withMessage('Адресът на фирмата е задължителен', requiredIf(this.IS_OWNER_BUSINESS))
            // }
        }
    },

    computed: {
        isFieldDisabled() {
            if (this.GET_CAR_HAS_PRICE) {
                return '';
            } else {
                return 'disabled';
            }
        },
        getUser() {
            return this.$store.getters['auth/GET_AUTH_USER'];
        },
        offerTitle: {
            get() {
                return this.$store.getters['sellCar/GET_OFFER_TITLE'];
            },
            set(value) {
                this.SET_OFFER_TITLE(value);
            }
        },
        offerDesc: {
            get() {
                return this.$store.getters['sellCar/GET_OFFER_DESC'];
            },
            set(value) {
                this.SET_OFFER_DESC(value);
            }
        },
        offerPrice: {
            get() {
                return this.$store.getters['sellCar/GET_CAR_PRICE'];
            },
            set(value) {
                this.SET_CAR_PRICE(value);
            }
        },

        offerCity: {
            get() {
                return this.$store.getters['sellCar/GET_CAR_OFFER_CITY'];
            },
            set(value) {
                this.SET_OFFER_CITY(value);
            }
        },

        offerRegion: {
            get() {
                return this.$store.getters['sellCar/GET_CAR_OFFER_REGION'];
            },
            set(value) {
                this.SET_OFFER_REGION(value);
            }
        },

        ...mapGetters('sellCar', [
            'getAllData',
            'GET_CAR_HAS_PRICE'
        ]),
    },
    methods: {
        ...mapMutations('sellCar', [
            'setStepMinus',
            'setStepPlus',
            'SET_OFFER_TITLE',
            'SET_OFFER_DESC',
            'SET_CAR_PRICE',
            'SET_OFFER_CITY',
            'SET_OFFER_REGION',
            'SET_CAR_HAS_PRICE'
        ]),

        togglePrice() {
            this.SET_CAR_PRICE(null);
            this.SET_CAR_HAS_PRICE(!this.GET_CAR_HAS_PRICE);
        },

        async showLastStep() {

            const isFormCorrect = await this.v$.$validate();
            if (!isFormCorrect) return;
            this.setStepPlus();
        },

        async fetchRegions() {
            try {
                const res = await axios.get('fetch/regions');

                if (res.data.success) {
                    this.regions = res.data.data;
                }
            } catch (e) {
                console.log(e, 'Could not fetch regions');
            }
        },

        async fetchCity(regionID) {
            try {
                const res = await axios.get(`fetch/cities/${regionID}`);

                if (res.data.success) {
                    this.cities = res.data.data;
                    this.asCity = res.data.asCity;
                }
            } catch (e) {
                console.log(e, 'Could not fetch cities');
            }
        }
    },
    mounted() {
        //tmp hack until I find way to use reducer func on vuex persist state
        this.$store.commit('sellCar/SET_OFFER_REGION', null);
        this.$store.commit('sellCar/SET_OFFER_CITY', null);
        this.fetchRegions();
    }
}
</script>

<style scoped>
.sell-car {
    max-width: 800px;
}
</style>
