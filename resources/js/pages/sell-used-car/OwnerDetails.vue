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
                                                message="Моля въвдете заглавие"/>
                </div>
                <div class="form-floating form-group">
                    <textarea class="form__input form-control" placeholder="Leave a comment here"
                              id="floatingTextarea" v-model.trim="offerDetails.offerDescription"></textarea>
                    <label for="floatingTextarea">Допълнителна информация</label>
                    <FromInputValidationMessage v-if="v$.offerDetails.offerDescription.$error"
                                                message="Моля въвдете информация"/>
                </div>
                <div class="form-floating form-group">
                    <input type="text" class="form-control form__input" id="floatingInputPrice"
                           placeholder="Цена на автомобила" v-model.trim="offerDetails.offerPrice">
                    <label for="floatingInputPrice">Цена (BGN)</label>
                    <FromInputValidationMessage v-if="v$.offerDetails.offerPrice.$error"
                                                message="Моля въвдете цена"/>
                </div>
            </div>
            <div>
                Публикува Бизнес Обява (От автокъща)
                <span @click="toggleBusinessOfferDetails = !toggleBusinessOfferDetails">
                    Да
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
                                                message="Моля валиден мобилен номер във формат 08хххххххх"/>
                </div>
                <div class="form-floating">
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
                <div class="form-floating">
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
                <div v-show="toggleBusinessOfferDetails">
                    <div class="question-section">
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
                offerPrice: {integer, required},
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
