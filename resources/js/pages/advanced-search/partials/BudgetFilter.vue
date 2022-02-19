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
import {onMounted, reactive, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import { isUndefined } from "lodash";

export default {
    name: "BudgetFilter",
    components: {
        Slider
    },
    setup() {
        const router = useRouter();
        const route = useRoute();
        let budgetRange = ref([]);

        budgetRange.value[0] = isUndefined(route.query.budgetMin) ? 0 : route.query.budgetMin;
        budgetRange.value[1] = isUndefined(route.query.budgetMax) ? 20000 : route.query.budgetMax;

        function handleBudgetSlider() {
            router.push(
                {
                    name: route.name,
                    query: {
                        ...route.query,
                        budgetMin: budgetRange.value[0],
                        budgetMax: budgetRange.value[1]
                    }
                }
            );
        }
        return {
            budgetRange,
            handleBudgetSlider
        }
    }
}
</script>
