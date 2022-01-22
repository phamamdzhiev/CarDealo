<template>


    <div class="sell-car">
        <base-card>
            <span @click="setStepMinus" class="back__button">Назад <i class="fw-light">(Стъпка 3)</i></span>
            <TopBar/>
            <div class="question-section mb-4">
                <h5 class="fw-bold">Гориво?</h5>
                <ul id="fuel">
                    <li :class="{ active: getAllData['car_fuel'] === 'Бензин'}"
                        @click="setCarFuel('Бензин')">Бензин
                    </li>
                    <li :class="{ active: getAllData['car_fuel'] === 'Дизел'}"
                        @click="setCarFuel('Дизел')">Дизел
                    </li>
                    <li :class="{ active: getAllData['car_fuel'] === 'Електрически'}"
                        @click="setCarFuel('Електрически')">
                        Електрически
                    </li>
                    <li :class="{ active: getAllData['car_fuel'] === 'Хибрид'}"
                        @click="setCarFuel('Хибрид')">Хибрид
                    </li>
                </ul>
            </div>
            <div class="question-section mb-4">
                <h5 class="fw-bold">Трансмисия?</h5>
                <ul id="transmission">
                    <li :class="{ active: getAllData['car_transmission'] === 'Ръчна'}"
                        @click="setCarTransmission('Ръчна')">
                        Ръчна
                    </li>
                    <li :class="{ active: getAllData['car_transmission'] === 'Автоматична'}"
                        @click="setCarTransmission('Автоматична')">Автоматична
                    </li>
                    <li :class="{ active: getAllData['car_transmission'] === 'Полуавтоматична'}"
                        @click="setCarTransmission('Полуавтоматична')">
                        Полуавтоматична
                    </li>
                </ul>
            </div>
            <div class="question-section">
                <h5 class="fw-bold">Кубатура, мощност, пробег?</h5>
                <div class="form-floating form-group">
                    <input type="number" id="cm3" class="form-control form__input"
                           v-model.number="carCm3"
                           @change="formatInputCm3"
                           placeholder="Кубатура"
                    />
                    <label for="cm3">Кубатура
                        <small class='input__error' v-if="errors.errorCm3">
                            <i>(Въведете реална кубатура)</i>
                        </small>
                    </label>
                </div>
                <div class="form-floating form-group">
                    <input type="number" id="horsepower" class="form-control form__input"
                           v-model.number="carHp"
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
                <div class="form-floating form-group">
                    <input type="number" id="km" class="form-control form__input"
                           v-model.number="carKm"
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
            <button @click="showStepFive" v-if="toggleNextStepButton" class="base-button">
                Следваща стъпкa
            </button>
        </base-card>
    </div>
</template>

<!-- get /set compute -->
<script>
import BaseCard from "../../components/ui/base/BaseCard.vue";
import TopBar from "./TopBar";
import {mapGetters, mapMutations} from "vuex";

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
            }
        }
    },
    computed: {
        ...mapGetters('sellCar', ['getAllData']),
        carHp: {
            get() {
                return this.getAllData['car_hp'];
            },
            set(val) {
                this.setCarHp(val);
            }
        },
        carCm3: {
            get() {
                return this.getAllData['car_cm3'];
            },
            set(val) {
                this.setCarCm3(val);
            }
        },
        carKm: {
            get() {
                return this.getAllData['car_km'];
            },
            set(val) {
                this.setCarKm(val);
            }
        },
        toggleNextStepButton() {
            return !!(this.getAllData['car_transmission'] &&
                this.getAllData['car_fuel'] &&
                this.getAllData['car_cm3'] &&
                this.getAllData['car_hp'] &&
                this.getAllData['car_km'] &&
                !this.errors.errorCm3 &&
                !this.errors.errorHp &&
                !this.errors.errorKm);
        }
    },

    methods: {
        ...mapMutations('sellCar', [
                'setStepMinus',
                'setStepPlus',
                'setCarFuel',
                'setCarTransmission',
                'setCarCm3',
                'setCarHp',
                'setCarKm'
            ]
        ),

        //some validation for inputs
        formatInputCm3() {
            this.errors.errorCm3 = this.getAllData['car_cm3'] >= 8000;
        },
        formatInputHp() {
            this.errors.errorHp = this.getAllData['car_hp'] >= 1500;
        },
        formatInputKm() {
            this.errors.errorKm = this.getAllData['car_km'] >= 1000000;
        },

        showStepFive() {
            if (!this.toggleNextStepButton) return;
            this.setStepPlus();
        }
    }
}
</script>

