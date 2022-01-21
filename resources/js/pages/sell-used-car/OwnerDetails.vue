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
                           v-model="offerTitle"
                    >
                    <label for="floatingInputOfferTitle">Заглавие на обявата</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Моля въведете заглавие"/>
                </div>
                <div class="form-floating form-group">
                    <textarea class="form__input form-control" placeholder="Допълнителна информация"
                              id="floatingTextarea"
                              v-model="offerDesc"
                    ></textarea>
                    <label for="floatingTextarea">Допълнителна информация</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Моля въведете информация"/>
                </div>
                <div class="form-floating form-group">
                    <select class="form__input form-select" id="floatingSelectRegion"
                            v-model="offerRegion"
                    >
                        <option value="София">София</option>
                        <option value="Пловдив">Пловдив</option>
                        <option value="Варна">Варна</option>
                    </select>
                    <label for="floatingSelectRegion">Моля изберете област</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Mоля изберете област"/>
                </div>
                <div class="form-floating form-group">
                    <select class="form__input form-select" id="floatingSelectCity"
                            v-model="offerCity"
                    >
                        <option value="One">One</option>
                        <option value="Two">Two</option>
                        <option value="Three">Three</option>
                    </select>
                    <label for="floatingSelectCity">Моля изберете населено място</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Mоля изберете град"/>
                </div>
                <div class="form-floating form-group">
                    <input type="number" class="form-control form__input" id="floatingInputPrice"
                           placeholder="Цена (BGN)" :disabled="GET_CAR_HAS_PRICE"
                           v-model="offerPrice"
                    >
                    <label for="floatingInputPrice">Цена (BGN)</label>
                    <div class="mt-1 ms-1 negotiable-price">
                        <label for="negotiable-price" :class="{ checked: GET_CAR_HAS_PRICE }">
                            <input type="checkbox" id="negotiable-price" v-show="false" @change="togglePrice"/>
                            По договаряне?
                        </label>
                    </div>
                    <FromInputValidationMessage v-if="false"
                                                message="Моля въведете валидна цена"/>
                </div>
            </div>
            <div :style="IS_OWNER_BUSINESS ? 'font-weight: bold' : 'font-weight: normal'"
                 class="d-flex justify-content-end align-items-center"
                 @click="toggleBusinessOffer"
                 style="cursor:pointer;user-select: none">
                Публикува Бизнес Обява?
                <span class="ms-2">
                    <svg v-show="!IS_OWNER_BUSINESS" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                         fill="currentColor" class="bi bi-toggle2-off" viewBox="0 0 16 16">
                      <path d="M9 11c.628-.836 1-1.874 1-3a4.978 4.978 0 0 0-1-3h4a3 3 0 1 1 0 6H9z"/>
                      <path d="M5 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1A5 5 0 1 0 5 3a5 5 0 0 0 0 10z"/>
                    </svg>
                    <svg v-show="IS_OWNER_BUSINESS" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                         fill="currentColor" class="bi bi-toggle2-on" viewBox="0 0 16 16">
                      <path
                          d="M7 5H3a3 3 0 0 0 0 6h4a4.995 4.995 0 0 1-.584-1H3a2 2 0 1 1 0-4h3.416c.156-.357.352-.692.584-1z"/>
                      <path d="M16 8A5 5 0 1 1 6 8a5 5 0 0 1 10 0z"/>
                    </svg>
                </span>
            </div>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Вашите детайли?</h5>
                <div class="form-floating form-group">
                    <input type="text" class="form-control form__input" id="floatingInputNames"
                           placeholder="Име и фамилия"
                           v-model="ownerNames"
                    >
                    <label for="floatingInputNames">Име и фамилия</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Моля въведете имена"/>
                </div>
                <div class="form-floating form-group">
                    <input type="email" class="form-control form__input" id="floatingInputEmail"
                           placeholder="Имейл адрес"
                           v-model.trim="ownerEmail">
                    <label for="floatingInputEmail">Имейл адрес</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Моля въведете валиден имейл адрес"
                    />
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form-control form__input" id="floatingInputMobile"
                           placeholder="Мобилен номер"
                           v-model.trim="ownerMobile">
                    <label for="floatingInputMobile">Мобилен номер</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Моля въведете валиден мобилен номер във формат 08хххххххх"/>
                </div>
            </div>
            <div class="question-section" v-if="IS_OWNER_BUSINESS">
                <h5 class="fw-bold">Детайли за фирмата?</h5>
                <div class="form-floating form-group">
                    <input type="text" class="form__input form-control" id="floatingInputCompany"
                           placeholder="Име на автокъщата"
                           v-model.trim="ownerCompanyName">
                    <label for="floatingInputCompany">Име на автокъщата</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Моля въведете име на автокъщата"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form__input form-control" id="floatingInputBulstat"
                           placeholder="Булстат/ЕИК"
                           v-model.trim="ownerCompanyEik">
                    <label for="floatingInputBulstat">Булстат/ЕИК</label>
                    <FromInputValidationMessage v-if="false"
                                                message="Моля въведете ЕИК на автокъщата"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form__input form-control" id="floatingInputAddress"
                           placeholder="Адрес на автокъщата"
                           v-model.trim="ownerCompanyAddress">
                    <label for="floatingInputAddress">Адрес на автокъщата</label>
                    <FromInputValidationMessage v-if="false"
                                                message="'Моля въведете адрес на автокъщата"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form__input form-control" id="floatingInputDomain"
                           placeholder="Личен домейн в CarDealo" v-model.trim="ownerCompanyURL">
                    <label for="floatingInputDomain">Личен домейн в CarDealo</label>
                </div>
            </div>
            <button @click="showLastStep" class="base-button">
                <span v-if="!isLoading">Качване на снимки</span>
                <loading-dots v-else></loading-dots>
            </button>
        </base-card>
        <button @click="showModal = true">Open Modal</button>
        <BaseModal v-if="showModal" @close-modal="showModal = false">
            <div class="form-group">
                <form @submit.prevent="">
                    <input type="text" placeholder="Въведете кода от емайла, който поличихте">
                    <button>Верифицирай</button>
                </form>
            </div>
        </BaseModal>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import BaseModal from "../../components/ui/base/BaseModal";
import useVuelidate from '@vuelidate/core';
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import {required, email, integer, maxLength, requiredIf, minValue} from '@vuelidate/validators'
import TopBar from "./TopBar";
import {mapGetters, mapMutations} from "vuex";

export default {
    name: "OwnerDetails",
    components: {
        TopBar,
        BaseCard,
        BaseModal,
        FromInputValidationMessage
    },
    data() {
        return {
            isLoading: false,
            showModal: false,
            hasPrice: false,
            toggleBusinessOfferDetails: false,
        }
    },

    computed: {
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

        ownerNames: {
            get() {
                return this.$store.getters['sellCar/GET_OWNER_NAMES'];
            },
            set(value) {
                this.SET_OWNER_NAME(value);
            }
        },

        ownerEmail: {
            get() {
                return this.$store.getters['sellCar/GET_OWNER_EMAIL'];
            },
            set(value) {
                this.SET_OWNER_EMAIL(value);
            }
        },

        ownerMobile: {
            get() {
                return this.$store.getters['sellCar/GET_OWNER_MOBILE'];
            },
            set(value) {
                this.SET_OWNER_MOBILE(value);
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

        ownerCompanyName: {
            get() {
                return this.$store.getters['sellCar/GET_OWNER_COMPANY_NAME'];
            },
            set(value) {
                this.SET_OWNER_COMPANY_NAME(value);
            }
        },

        ownerCompanyAddress: {
            get() {
                return this.$store.getters['sellCar/GET_OWNER_COMPANY_ADDRESS'];
            },
            set(value) {
                this.SET_OWNER_COMPANY_ADDRESS(value);
            }
        },
        ownerCompanyEik: {
            get() {
                return this.$store.getters['sellCar/GET_OWNER_COMPANY_EIK'];
            },
            set(value) {
                this.SET_OWNER_COMPANY_EIK(value);
            }
        },
        ownerCompanyURL: {
            get() {
                return this.$store.getters['sellCar/GET_OWNER_COMPANY_URL'];
            },
            set(value) {
                this.SET_OWNER_COMPANY_URL(value);
            }
        },

        ...mapGetters('sellCar', [
            'getAllData',
            'GET_CAR_HAS_PRICE',
            'IS_OWNER_BUSINESS'
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
            'SET_CAR_HAS_PRICE',
            'SET_OWNER_NAME',
            'SET_OWNER_EMAIL',
            'SET_OWNER_MOBILE',
            'SET_OWNER_STATUTE',
            'SET_OWNER_COMPANY_NAME',
            'SET_OWNER_COMPANY_ADDRESS',
            'SET_OWNER_COMPANY_EIK',
            'SET_OWNER_COMPANY_URL',
        ]),

        togglePrice() {
            this.SET_CAR_PRICE(null);
            this.SET_CAR_HAS_PRICE(!this.GET_CAR_HAS_PRICE);
        },

        toggleBusinessOffer() {
            if (!this.IS_OWNER_BUSINESS) {
                this.SET_OWNER_COMPANY_NAME(null);
                this.SET_OWNER_COMPANY_ADDRESS(null);
                this.SET_OWNER_COMPANY_EIK(null);
                this.SET_OWNER_COMPANY_URL(null);
            }

            this.SET_OWNER_STATUTE(!this.IS_OWNER_BUSINESS);
        },
        async showLastStep(key, value) {
            try {
                this.isLoading = true;
                const response = await axios.post('/api/generate-email-verification-code', this.ownerDetails);
                this.isLoading = false;
            } catch (e) {
                console.log(e, 'Email generate code failed');
            }

            // this.setStepPlus();
        },
    }
}
</script>

<style scoped>
.sell-car {
    max-width: 800px;
}
</style>
