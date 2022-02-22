<template>
    <div class="sell-car">
        <base-card>
            <TopBar/>
            <div class="question-section">
                <h5 class="fw-bold">Година на производство?</h5>
                <ul id="year">
                    <li v-for="year in years"
                        :key="year"
                        :class="{ active: year === getAllData['car_year'] }"
                        @click="setCarYear(year)"
                    >
                        {{ year }}
                    </li>
                </ul>
            </div>
            <button @click="showStepThree" class="base-button" v-if="getAllData['car_year']">
                Следваща стъпкa
            </button>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard.vue";
import TopBar from "./TopBar";
import {mapGetters, mapMutations} from "vuex";

export default {
    name: "SellCarYear",
    components: {
        TopBar,
        BaseCard
    },
    data() {
        return {
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
        ...mapGetters('sellCar', ['getAllData']),
    },
    methods: {
        ...mapMutations('sellCar', ['setStepMinus', 'setStepPlus', 'setCarYear']),

        showStepThree() {
            if (!this.getAllData['car_year']) return;
            this.setStepPlus();
        },
    }
}
</script>

<style scoped>
a {
    display: block;
}
</style>
