<template>
    <div class="sell-car">
        <base-card>
            <span @click="back" class="back__button">Назад <i class="fw-light">(Стъпка 5)</i></span>
            <div class="currently__chosen my-3">
                <span>
                    {{ getAllData['car_brand'] }}
                </span>
                <span>
                    {{ getAllData['car_year'] }}
                </span>
                <span>
                    {{ getAllData['car_model'] }}
                </span>
                <span>
                    {{ getAllData['car_fuel'] }}
                </span>
                <span>
                    {{ getAllData['car_transmission'] }} кутия
                </span>
                <span>
                    {{ getAllData['car_hp'] }} к.с.
                </span>
                <span>
                    {{ getAllData['car_km'] }} км.
                </span>
            </div>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Детайли по обявата?</h5>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control form__input" id="floatingInputOfferTitle"
                           placeholder="Залавие на обявата" v-model.trim="offerDetails.offerTitle">
                    <label for="floatingInputOfferTitle">Заглавие</label>
                </div>
                <div class="form-floating">
                    <textarea class="form__input form-control" placeholder="Leave a comment here" rows="4"
                              id="floatingTextarea" v-model.trim="offerDetails.offerDescription"></textarea>
                    <label for="floatingTextarea">Допълнителна информация</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control form__input" id="floatingInputPrice"
                           placeholder="Цена на автомобила" v-model.trim="offerDetails.offerPrice">
                    <label for="floatingInputPrice">Цена (BGN)</label>
                </div>
            </div>
            <div>
                Публикува Бизнес Обява
                <span @click="toggleBussinessOffer">
                    Да
                </span>
            </div>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Вашите детайли?</h5>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control form__input" id="floatingInputNames"
                           placeholder="(Иван Иванов)" v-model.trim="ownerDetails.ownerNames">
                    <label for="floatingInputNames">Име и фамилия</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" class="form-control form__input" id="floatingInputEmail"
                           placeholder="(ivan.ivano@email.bg)" v-model.trim="ownerDetails.ownerEmail">
                    <label for="floatingInputEmail">Имейл адрес</label>
                    <div v-if="v$.ownerDetails.ownerEmail.$error">Name field has an error.</div>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control form__input" id="floatingInputMobile"
                           placeholder="(ivan.ivano@email.bg)" v-model.trim="ownerDetails.ownerMobile">
                    <label for="floatingInputMobile">Мобилен номер</label>
                </div>
                <div class="form-floating">
                    <select class="form__input form-select" id="floatingSelectRegion"
                            v-model.trim="ownerDetails.ownerRegion"
                    >
                        <option value="София">София</option>
                        <option value="Пловдив">Пловдив</option>
                        <option selected>Моля изберете област</option>
                        <option value="Варна">Варна</option>
                    </select>
                    <label for="floatingSelectRegion">Област</label>
                </div>
                <div class="form-floating">
                    <select class="form__input form-select" id="floatingSelectCity"
                            v-model.trim="ownerDetails.ownerCity"
                    >
                        <option value="One">One</option>
                        <option value="Two">Two</option>
                        <option value="Three">Three</option>
                        <option selected>Моля изберете населено място</option>
                    </select>
                    <label for="floatingSelectCity">Населено място</label>
                </div>
                <div v-show="toggleBusinessOfferDetails">
                    <div class="question-section">
                        <h5 class="fw-bold">Детайли за фирмата?</h5>
                        <div class="form-floating mb-2">
                            <input type="text" class="form__input form-control" id="floatingInputCompany"
                                   placeholder="име на фирмата" v-model.trim="ownerDetails.businessOffer.companyName">
                            <label for="floatingInputCompany">Име на фирмата</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form__input form-control" id="floatingInputBulstat"
                                   placeholder="булстат на фирмата"
                                   v-model.trim="ownerDetails.businessOffer.companyEIK">
                            <label for="floatingInputBulstat">Булстат/ЕИК</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form__input form-control" id="floatingInputAddress"
                                   placeholder="адрес на автокъщата"
                                   v-model.trim="ownerDetails.businessOffer.companyAddress">
                            <label for="floatingInputAddress">Адрес на атвокъщата</label>
                        </div>
                        <div class="form-floating mb-2">
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
import useVuelidate from '@vuelidate/core'
import {required, email} from '@vuelidate/validators'

export default {
    name: "OwnerDetails",
    components: {
        BaseCard
    },
    data() {
        return {
            v$: useVuelidate(),
            toggleBusinessOfferDetails: false,
            offerDetails: {
                offerTitle: null,
                offerDescription: null,
                offerPrice: null,
            },
            ownerDetails: {
                ownerNames: null,
                ownerEmail: null,
                ownerMobile: null,
                ownerRegion: [],
                ownerCity: [],
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
            ownerDetails: {
                ownerEmail: {required, email}
            }
        }
    },
    computed: {
        getAllData() {
            return this.$store.getters['sellCar/getAllData'];
        },
    },
    methods: {
        back() {
            this.$store.commit('sellCar/setStepMinus');
        },
         showLastStep() {
            const isFormCorrect = this.v$.$validate()
            if (!isFormCorrect) return
            this.$store.commit('sellCar/setCarDetails', this.offerDetails);
            this.$store.commit('sellCar/setStepPlus');
        },
        toggleBussinessOffer() {
            this.toggleBusinessOfferDetails = !this.toggleBusinessOfferDetails;
        }
    },
}
</script>

<style scoped>
.sell-car {
    max-width: 800px;
}
</style>
