<template>
    <div class="sell-car">
        <base-card>
            <span @click="back" class="back__button">Назад <i class="fw-light">(Стъпка 3)</i></span>
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
            </div>

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
                    <input type="number" min="0" id="cm3" class="form-control form__input" v-model="dataStepFour.cm3"
                           placeholder="Кубатура">
                    <label for="cm3">Кубатура</label>
                </div>
                <div class="form-floating">
                    <input type="number" min="0" id="horsepower" class="form-control form__input"
                           v-model="dataStepFour.hp"
                           placeholder="Мощност (к.с)">
                    <label for="horsepower">Мощност (к.с)</label>
                </div>
                <div class="form-floating">
                    <input type="number" min="0" id="km" class="form-control form__input" v-model="dataStepFour.km"
                           placeholder="Пробег (км.)">
                    <label for="horsepower">Пробег (км.)</label>
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

export default {
    name: "SellCarVariant",
    components: {
        BaseCard
    },
    data() {
        return {
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
            return this.dataStepFour.transmission && this.dataStepFour.fuel;
        }
    },

    methods: {
        back() {
            this.$store.commit('sellCar/setStepMinus');
        },

        async showStepFive() {
            if (!this.toggleNextStepButton) {
                return
            }

            this.$store.commit('sellCar/setCarVariant', this.dataStepFour);
            this.$store.commit('sellCar/setStepPlus');
        }
    }
}
</script>
