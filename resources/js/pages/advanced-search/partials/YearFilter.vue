<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Година</h6>
        <div class="fw-bold text-base-color mb-3 text-center">
            <span>{{ yearRange[0] }} г. - </span>
            <span>{{ yearRange[1] }} г.</span>
        </div>
        <Slider v-model="yearRange"
                :max="2022"
                :min="1995"
                :step="1"
                :tooltips="false"
                :lazy="false"
                class="advanced-filter-range-slider"
                @change="handleYearSlider"
        >
        </Slider>
    </div>
</template>

<script>
import Slider from '@vueform/slider';
import '@vueform/slider/themes/default.css';
import {onMounted, reactive, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {isUndefined} from "lodash";

export default {
    name: "YearFilter",
    components: {
        Slider
    },
    setup() {
        const router = useRouter();
        const route = useRoute();
        let yearRange = ref([]);

        yearRange.value[0] = isUndefined(route.query.yearMin) ? 1995 : route.query.yearMin;
        yearRange.value[1] = isUndefined(route.query.yearMax) ? 2022 : route.query.yearMax;

        function handleYearSlider() {
            router.push({
                name: route.name,
                query: {
                    ...route.query,
                    yearMin: yearRange.value[0],
                    yearMax: yearRange.value[1]
                }
            });
        }

        return {
            yearRange,
            handleYearSlider
        }
    }
}
</script>
