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
                        :class="{ active: year === getState.year }"
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
import {mapMutations} from "vuex";
import {years} from "../../helpers/years";

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
            years
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
            this.setVehicleState({key: 'year', value: year});
        }
    }
}
</script>
