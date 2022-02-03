<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Бюджет</h6>
        <div class="fw-bold text-base-color mb-3 text-center">
            <span>{{ value[0] }} лв. - </span>
            <span>{{ value[1] }} лв.</span>
        </div>
        <Slider v-model="value"
                :max="20000"
                :step="500"
                :tooltips="false"
                :lazy="false"
                class="advanced-filter-range-slider">
        </Slider>
    </div>
</template>

<script>
import Slider from '@vueform/slider';
import '@vueform/slider/themes/default.css';
import {ref} from "vue";

export default {
    name: "BudgetFilter",
    components: {
        Slider
    },
    setup() {
        let value = ref([0, 20000]);

        return {
            value
        }
    }
}
</script>
