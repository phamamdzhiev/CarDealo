<template>
    <div class="sell-car">
        <base-card>
            <span @click="back" class="back__button">Назад <i class="fw-light">(Стъпка 1)</i></span>
            <TopBar/>
            <div class="question-section">
                <h5 class="fw-bold">Година на производство?</h5>
                <ul id="year">
                    <li v-for="(year, index) in years"
                        :key="year"
                        :class="{ active: index === current }"
                        @click="chooseYear(year, index)"
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
import TopBar from "./TopBar";

export default {
    name: "SellCarYear",
    components: {
        TopBar,
        BaseCard
    },
    data() {
        return {
            current: null,
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
        chooseYear(year, index) {
            this.dataStepTwo.selectedYear = year;
            this.current = index;
        }
    }
}
</script>

<style scoped>
a {
    display: block;
}
</style>
