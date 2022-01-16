<template>
    <div class="sell-car">
        <base-card>
            <span @click="back" class="back__button">Назад <i class="fw-light">(Стъпка 5)</i></span>
            <TopBar/>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Детайли по обявата?</h5>
                <div class="form-floating form-group">
                    <input type="text" class="form-control form__input" id="floatingInputOfferTitle"
                           placeholder="Залавие на обявата" v-model.trim="offerDetails.offerTitle">
                    <label for="floatingInputOfferTitle">Заглавие</label>
                    <FromInputValidationMessage v-if="v$.offerDetails.offerTitle.$error"
                                                message="Моля въведете заглавие"/>
                </div>
                <div class="form-floating form-group">
                    <textarea class="form__input form-control" placeholder="Leave a comment here"
                              id="floatingTextarea" v-model.trim="offerDetails.offerDescription"></textarea>
                    <label for="floatingTextarea">Допълнителна информация</label>
                    <FromInputValidationMessage v-if="v$.offerDetails.offerDescription.$error"
                                                message="Моля въведете информация"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form-control form__input" id="floatingInputPrice"
                           placeholder="Цена на автомобила" :disabled="price" v-model.trim="offerDetails.offerPrice">
                    <label for="floatingInputPrice">Цена (BGN)</label>
                    <div class="mt-1 ms-1 negotiable-price">
                        <label for="negotiable-price" :class="{ checked: price }">
                            <input type="checkbox" id="negotiable-price" v-show="false" @change="togglePrice"/>
                            По договаряне?
                        </label>
                    </div>
                    <FromInputValidationMessage v-if="v$.offerDetails.offerPrice.$error"
                                                message="Моля въведете цена"/>
                </div>
            </div>
            <div :style="toggleBusinessOfferDetails ? 'font-weight: bold' : 'font-weight: normal'"
                 class="d-flex justify-content-end align-items-center"
                 @click="toggleBusinessOfferDetails = !toggleBusinessOfferDetails"
                 style="cursor:pointer;user-select: none">
                Публикува Бизнес Обява?
                <span class="ms-2">
                    <svg v-show="!toggleBusinessOfferDetails" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                         fill="currentColor" class="bi bi-toggle2-off" viewBox="0 0 16 16">
                      <path d="M9 11c.628-.836 1-1.874 1-3a4.978 4.978 0 0 0-1-3h4a3 3 0 1 1 0 6H9z"/>
                      <path d="M5 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1A5 5 0 1 0 5 3a5 5 0 0 0 0 10z"/>
                    </svg>
                    <svg v-show="toggleBusinessOfferDetails" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
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
                           placeholder="(Иван Иванов)" v-model.trim="ownerDetails.ownerNames">
                    <label for="floatingInputNames">Име и фамилия</label>
                    <FromInputValidationMessage v-if="v$.ownerDetails.ownerNames.$error"
                                                message="Моля въведете имена"/>
                </div>
                <div class="form-floating form-group">
                    <input type="email" class="form-control form__input" id="floatingInputEmail"
                           placeholder="(ivan.ivano@email.bg)" v-model.trim="ownerDetails.ownerEmail">
                    <label for="floatingInputEmail">Имейл адрес</label>
                    <FromInputValidationMessage v-if="v$.ownerDetails.ownerEmail.$error"
                                                message="Моля въведете валиден имейл"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form-control form__input" id="floatingInputMobile"
                           placeholder="(ivan.ivano@email.bg)" v-model.trim="ownerDetails.ownerMobile">
                    <label for="floatingInputMobile">Мобилен номер</label>
                    <FromInputValidationMessage v-if="v$.ownerDetails.ownerMobile.$error"
                                                message="Моля въведете валиден мобилен номер във формат 08хххххххх"/>
                </div>
                <div class="form-floating form-group">
                    <select class="form__input form-select" id="floatingSelectRegion"
                            ref="region"
                            @change="setRegion"
                    >
                        <option value="" selected>Моля изберете област</option>
                        <option value="София">София</option>
                        <option value="Пловдив">Пловдив</option>
                        <option value="Варна">Варна</option>
                    </select>
                    <label for="floatingSelectRegion">Област</label>
                </div>
                <div class="form-floating form-group">
                    <select class="form__input form-select" id="floatingSelectCity"
                            ref="city"
                            @change="setCity"
                    >
                        <option value="" selected>Моля изберете населено място</option>
                        <option value="One">One</option>
                        <option value="Two">Two</option>
                        <option value="Three">Three</option>
                    </select>
                    <label for="floatingSelectCity">Населено място</label>
                </div>
            </div>
            <div class="question-section" v-show="toggleBusinessOfferDetails">
                <h5 class="fw-bold">Детайли за фирмата?</h5>
                <div class="form-floating form-group">
                    <input type="text" class="form__input form-control" id="floatingInputCompany"
                           placeholder="име на фирмата" v-model.trim="ownerDetails.businessOffer.companyName">
                    <label for="floatingInputCompany">Име на автокъщата</label>
                    <FromInputValidationMessage v-if="v$.ownerDetails.businessOffer.companyName.$error"
                                                message="Моля въведете име на автокъщата"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form__input form-control" id="floatingInputBulstat"
                           placeholder="булстат на фирмата"
                           v-model.trim="ownerDetails.businessOffer.companyEIK">
                    <label for="floatingInputBulstat">Булстат/ЕИК</label>
                    <FromInputValidationMessage v-if="v$.ownerDetails.businessOffer.companyEIK.$error"
                                                message="Моля въведете ЕИК на автокъщата"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form__input form-control" id="floatingInputAddress"
                           placeholder="адрес на автокъщата"
                           v-model.trim="ownerDetails.businessOffer.companyAddress">
                    <label for="floatingInputAddress">Адрес на автокъщата</label>
                    <FromInputValidationMessage v-if="v$.ownerDetails.businessOffer.companyAddress.$error"
                                                message="'Моля въведете адрес на автокъщата"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form__input form-control" id="floatingInputDomain"
                           placeholder="домейн в Cardealo" v-model.trim="ownerDetails.businessOffer.companyURL">
                    <label for="floatingInputDomain">Личен домейн в CarDealo</label>
                </div>
            </div>
            <button @click="showLastStep" class="base-button">
                Качване на снимки
            </button>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import useVuelidate from '@vuelidate/core';
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import {required, email, integer, maxLength, requiredIf} from '@vuelidate/validators'
import TopBar from "./TopBar";

export default {
    name: "OwnerDetails",
    components: {
        TopBar,
        BaseCard,
        FromInputValidationMessage
    },
    data() {
        return {
            // v$: useVuelidate(),
            price: false,
            toggleBusinessOfferDetails: false,
            offerDetails: {
                offerTitle: null,
                offerDescription: null,
                offerPrice: null,
                offerRegion: null,
                offerCity: null,
            },
            ownerDetails: {
                ownerNames: null,
                ownerEmail: null,
                ownerMobile: null,
                businessOffer: {
                    companyName: null,
                    companyEIK: null,
                    companyAddress: null,
                    companyURL: null,
                }
            }
        }
    },
    validations() {
        return {
            offerDetails: {
                offerTitle: {required},
                offerDescription: {required},
                offerPrice: {integer, requiredIf: requiredIf(!this.price)},
            },
            ownerDetails: {
                ownerNames: {required},
                ownerEmail: {required, email},
                ownerMobile: {required, integer, maxLength: maxLength(10)},
                businessOffer: {
                    companyName: {requiredIf: requiredIf(this.toggleBusinessOfferDetails)},
                    companyEIK: {integer, requiredIf: requiredIf(this.toggleBusinessOfferDetails)},
                    companyAddress: {requiredIf: requiredIf(this.toggleBusinessOfferDetails)},
                }
            }
        }
    },
    computed: {
        getAllData() {
            return this.$store.getters['sellCar/getAllData'];
        },
    },
    setup() {
        return {
            v$: useVuelidate()
        }
    },
    methods: {
        back() {
            this.$store.commit('sellCar/setStepMinus');
        },
        togglePrice() {
            this.offerDetails.offerPrice = null;
            this.price = !this.price;
        },
        setCity() {
            let value = this.$refs.city.value;
            if (!value || value === '') {
                this.offerDetails.offerCity = null;
                return;
            }
            this.offerDetails.offerCity = value
        },
        setRegion() {
            let value = this.$refs.region.value;
            if (!value || value === '') {
                this.offerDetails.offerRegion = null;
                return;
            }
            this.offerDetails.offerRegion = value
        },
        async showLastStep() {
            const isFormCorrect = await this.v$.$validate();

            if (!isFormCorrect) return;

            this.$store.commit('sellCar/setCarDetails', this.offerDetails);
            this.$store.commit('sellCar/setStepPlus');
        },
    }
}
</script>

<style scoped>
.sell-car {
    max-width: 800px;
}
</style>
