<template>
    <div class="sell-car">
        <base-card>
            <span @click="back" class="back__button">Назад <i class="fw-light">(Стъпка 2)</i></span>
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
                '2017',
                '2016',
                '2015',
                '2014',
                '2013',
                '2012',
                '2011',
                '2010',
                '2009',
                '2008',
                '2007',
                '2006',
                '2005',
                '2004',
                '2003',
                '2002',
                '2001',
                '2000',
                '1999',
                '1998',
                '1997',
                '1996',
                '1995',
                '1994',
                '1993',
                '1992',
                '1991',
                '1990',
                '1989',
                '1988',
                '1987',
                '1986',
                '1985',
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
