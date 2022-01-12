<template>
    <div class="sell-car">
        <base-card>
            <span @click="back" class="back__button">Назад <i class="fw-light">(Стъпка 3)</i></span>
            <TopBar/>
            <div class="question-section mb-4">
                <h5 class="fw-bold">Гориво?</h5>
                <ul id="fuel">
                    <li :class="{ active: dataStepFour.fuel === 'Бензин'}"
                        @click="dataStepFour.fuel = 'Бензин'">Бензин
                    </li>
                    <li :class="{ active: dataStepFour.fuel === 'Дизел'}"
                        @click="dataStepFour.fuel = 'Дизел'">Дизел
                    </li>
                    <li :class="{ active: dataStepFour.fuel === 'Електрически'}"
                        @click="dataStepFour.fuel = 'Електрически'">
                        Електрически
                    </li>
                    <li :class="{ active: dataStepFour.fuel === 'Хибрид'}"
                        @click="dataStepFour.fuel = 'Хибрид'">Хибрид
                    </li>
                </ul>
            </div>
            <div class="question-section mb-4">
                <h5 class="fw-bold">Трансмисия?</h5>
                <ul id="transmission">
                    <li :class="{ active: dataStepFour.transmission === 'Ръчна'}"
                        @click="dataStepFour.transmission = 'Ръчна'">
                        Ръчна
                    </li>
                    <li :class="{ active: dataStepFour.transmission === 'Автоматична'}"
                        @click="dataStepFour.transmission = 'Автоматична'">Автоматична
                    </li>
                    <li :class="{ active: dataStepFour.transmission === 'Полуавтоматична'}"
                        @click="dataStepFour.transmission = 'Полуавтоматична'">
                        Полуавтоматична
                    </li>
                </ul>
            </div>
            <div class="question-section">
                <h5 class="fw-bold">Кубатура, мощност, пробег?</h5>
                <div class="form-floating">
                    <input type="number" id="cm3" class="form-control form__input"
                           v-model.number="dataStepFour.cm3"
                           @change="formatInputCm3"
                           placeholder="Кубатура"
                    />
                    <label for="cm3">Кубатура
                        <small class='input__error' v-if="errors.errorCm3">
                            <i>(Въведете реална кубатура)</i>
                        </small>
                    </label>
                </div>
                <div class="form-floating">
                    <input type="number" id="horsepower" class="form-control form__input"
                           v-model.number="dataStepFour.hp"
                           @change="formatInputHp"
                           placeholder="Мощност (к.с)"
                    />
                    <label for="horsepower">
                        Мощност (к.с)
                        <small class='input__error' v-if="errors.errorHp">
                            <i>(Въведете реали конски сили)</i>
                        </small>
                    </label>
                </div>
                <div class="form-floating">
                    <input type="number" id="km" class="form-control form__input"
                           v-model.number="dataStepFour.km"
                           @change="formatInputKm"
                           placeholder="Пробег (км.)"
                    />
                    <label for="horsepower">
                        Пробег (км.)
                        <small class='input__error' v-if="errors.errorKm">
                            <i>(Въведете реален пробег)</i>
                        </small>
                    </label>
                </div>
            </div>
            <button @click="showStepFive" v-show="toggleNextStepButton" class="base-button">
                Следваща стъпкa
            </button>
        </base-card>
    </div>
</template>


<script>
import BaseCard from "../../components/ui/base/BaseCard.vue";
import TopBar from "./TopBar";

export default {
    name: "SellCarVariant",
    components: {
        TopBar,
        BaseCard
    },
    data() {
        return {
            errors: {
                errorCm3: false,
                errorHp: false,
                errorKm: false,
            },
            dataStepFour: {
                fuel: null,
                transmission: null,
                cm3: null,
                hp: null,
                km: null,
            }
        }
    },
    computed: {
        getAllData() {
            return this.$store.getters['sellCar/getAllData'];
        },

        toggleNextStepButton() {
            return !!(this.dataStepFour.transmission &&
                this.dataStepFour.fuel &&
                this.dataStepFour.cm3 &&
                this.dataStepFour.hp &&
                this.dataStepFour.km &&
                !this.errors.errorCm3 &&
                !this.errors.errorHp &&
                !this.errors.errorKm);
        }
    },

    methods: {
        back() {
            this.$store.commit('sellCar/setStepMinus');
        },
        //some validation for inputs
        formatInputCm3() {
            this.errors.errorCm3 = this.dataStepFour.cm3 >= 8000;
        },
        formatInputHp() {
            this.errors.errorHp = this.dataStepFour.hp >= 1500;
        },
        formatInputKm() {
            this.errors.errorKm = this.dataStepFour.km >= 1000000;
        },

        showStepFive() {
            if (!this.toggleNextStepButton) return;

            this.$store.commit('sellCar/setCarVariant', this.dataStepFour);
            this.$store.commit('sellCar/setStepPlus');
        }
    }
}
</script>

