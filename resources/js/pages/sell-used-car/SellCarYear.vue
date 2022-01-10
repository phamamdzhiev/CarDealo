<template>
    <div class="sell-car">
        <base-card>
            <span @click="back" class="back__button">Назад <i class="fw-light">(Стъпка 1)</i></span>
            <div class="currently__chosen my-3">
                <span>
                    {{ getAllData['car_brand'] }}
                </span>
            </div>

            <div class="question-section">
                <h5 class="fw-bold">Година на производство?</h5>
                <ul id="year">
                    <li v-for="year in years"
                        :key="year"
                        :data-year="year"
                        ref="element"
                        @click="chooseYear(year)"
                    >
                        {{ year }}
                    </li>
                </ul>
            </div>
            <button @click="showStepThree" class="base-button" v-if="dataStepTwo.selectedYear">
                Следваща стъпкa
            </button>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard.vue";

export default {
    name: "SellCarYear",
    components: {
        BaseCard
    },
    data() {
        return {
            dataStepTwo: {
                selectedYear: null,
            },
            years: [
                '2022',
                '2021',
                '2019',
                '2018',
                '2017'
            ]
        }
    },
    computed: {
        getAllData() {
            return this.$store.getters['sellCar/getAllData'];
        },
        getStep() {
            return this.$store.getters['sellCar/getStep'];
        }
    },
    methods: {
        back() {
            this.$store.commit('sellCar/setStepMinus');
        },
        showStepThree() {
            if (!this.dataStepTwo.selectedYear) {
                return
            }
            this.$store.commit('sellCar/setStepPlus');
            this.$store.commit('sellCar/setCarYear', this.dataStepTwo.selectedYear);
        },
        chooseYear(year) {
            this.$refs.element.forEach((ref) => {
                ref.classList.remove('active');
                if (year === ref.getAttribute('data-year')) {
                    ref.classList.add('active');
                    this.dataStepTwo.selectedYear = year;
                }
            })
        }
    }
}
</script>

<style scoped>
a {
    display: block;
}
</style>
