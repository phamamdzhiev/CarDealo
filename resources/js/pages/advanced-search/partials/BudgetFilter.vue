<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Бюджет</h6>
        <div class="fw-bold text-base-color mb-3 text-center">
            <span>{{ budgetRange[0] }} лв. - </span>
            <span>{{ budgetRange[1] }} лв.</span>
        </div>
        <Slider v-model="budgetRange"
                :max="20000"
                :step="500"
                :tooltips="false"
                :lazy="false"
                class="advanced-filter-range-slider"
                @change="handleBudgetSlider"
        >
        </Slider>
    </div>
</template>

<script>
import Slider from '@vueform/slider';
import '@vueform/slider/themes/default.css';
import {reactive, ref} from "vue";
import {useRoute, useRouter} from "vue-router";

export default {
    name: "BudgetFilter",
    components: {
        Slider
    },
    setup() {
        const router = useRouter();
        const route = useRoute();
        let budgetRange = ref([]);

        if (Object.keys(route.query).length === 0) {
            budgetRange.value[0] = 0;
            budgetRange.value[1] = 20000;
        }else {
            let splitRouteParams = route.query.budget.split('-');

            budgetRange.value[0] = Number(splitRouteParams[0]);
            budgetRange.value[1] = Number(splitRouteParams[1]);
        }

        function handleBudgetSlider() {
            router.push({name: 'used-cars', query: { budget: budgetRange.value[0] + '-' + budgetRange.value[1] }});
        }
        return {
            budgetRange,
            handleBudgetSlider
        }
    }
}
</script>
