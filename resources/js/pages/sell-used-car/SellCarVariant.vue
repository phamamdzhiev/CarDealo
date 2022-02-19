<template>


    <div class="sell-car">
        <base-card>
            <span @click="setStepMinus" class="back__button">Назад <i class="fw-light">(Стъпка 3)</i></span>
            <TopBar/>
            <div class="question-section mb-4">
                <h5 class="fw-bold">Гориво?</h5>
                <ul id="fuel">
                    <li :class="{ active: getAllData['car_fuel'] === 1}"
                        @click="setCarFuel(1)">Бензин
                    </li>
                    <li :class="{ active: getAllData['car_fuel'] === 2}"
                        @click="setCarFuel(2)">Дизел
                    </li>
                    <li :class="{ active: getAllData['car_fuel'] === 3}"
                        @click="setCarFuel(3)">
                        Електрически
                    </li>
                    <li :class="{ active: getAllData['car_fuel'] === 4}"
                        @click="setCarFuel(4)">Хибрид
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
                           placeholder="Кубатура"
                    />
                    <label for="cm3">Кубатура</label>
                    <FromInputValidationMessage v-if="v$.carCm3.$error"
                                                :messages="v$.carCm3.$errors"
                    />
                </div>
                <div class="form-floating form-group">
                    <input type="number" id="horsepower" class="form-control form__input"
                           v-model.number="carHp"
                           placeholder="Мощност (к.с)"
                    />
                    <label for="horsepower">Мощност (к.с)</label>
                    <FromInputValidationMessage v-if="v$.carHp.$error"
                                                :messages="v$.carHp.$errors"
                    />
                </div>
                <div class="form-floating form-group">
                    <cleave
                        id="km" class="form-control form__input"
                        v-model.number="carKm"
                        placeholder="Пробег (км.)"
                        :options="{  numeral: true, delimiter: ' ', numeralThousandsGroupStyle: 'thousand'}"
                    />
<!--                    <input type="number" id="km" class="form-control form__input"-->
<!--                           v-model.number="carKm"-->
<!--                           placeholder="Пробег (км.)"-->
<!--                    />-->
                    <label for="horsepower">Пробег (км.)</label>
                    <FromInputValidationMessage v-if="v$.carKm.$error"
                                                :messages="v$.carKm.$errors"
                    />
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
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import useVuelidate from '@vuelidate/core';
import {required, integer, minValue, maxValue, helpers} from '@vuelidate/validators'
import Cleave from "vue-cleave-component";

export default {
    name: "SellCarVariant",
    components: {
        TopBar,
        BaseCard,
        FromInputValidationMessage,
        Cleave
    },
    data() {
        return {
            v$: useVuelidate(),
            errors: {
                errorCm3: false,
                errorHp: false,
                errorKm: false,
            }
        }
    },
    validations() {
        return {
            carHp: {
                required: helpers.withMessage('Задължително поле', required),
                maxValue: helpers.withMessage('Въведете реални конски сили', maxValue(2500)),
                minValue: helpers.withMessage('Въведете реални конски сили', minValue(20)),
            },
            carCm3: {
                required: helpers.withMessage('Задължително поле', required),
                maxValue: helpers.withMessage('Въведете реална кубатура', maxValue(8000)),
                minValue: helpers.withMessage('Въведете реална кубатура', minValue(1)),
            },
            carKm: {
                required: helpers.withMessage('Задължително поле', required),
                maxValue: helpers.withMessage('Въведете реален пробег', maxValue(999999)),
                minValue: helpers.withMessage('Въведете реален пробег', minValue(1)),
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
                this.getAllData['car_km']
            );
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

        async showStepFive() {
            const isFormCorrect = await this.v$.$validate();
            if (!isFormCorrect) return;

            this.setStepPlus();
        }
    }
}
</script>

