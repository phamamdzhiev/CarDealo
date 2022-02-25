<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <div class="question-section">
                <Heading title="Година на производство?"/>
                <ul id="year">
                    <li v-for="year in years"
                        :key="year"
                        :class="{ active: parseInt(year) === getState.year }"
                        @click="setYear(year)"
                    >
                        {{ year }}
                    </li>
                </ul>
            </div>
            <NextStepButton v-if="getState.year"/>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard.vue";
import TopBar from "./TopBar";
import NextStepButton from "./partials/NextStepButton";
import PrevStepButton from "./partials/PrevStepButton";
import Heading from "./partials/Heading";
import {mapGetters, mapMutations} from "vuex";

export default {
    name: "VehicleYear",
    components: {
        TopBar,
        BaseCard,
        NextStepButton,
        PrevStepButton,
        Heading
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
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        }
    },
    methods: {
        ...mapMutations('uploadOffer', ['setStepPlus', 'setVehicleState']),
        setYear(year) {
            this.setVehicleState({key: 'year', value: parseInt(year)});
        }
    }
}
</script>
