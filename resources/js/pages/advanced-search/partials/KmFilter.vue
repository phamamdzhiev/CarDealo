<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Пробег</h6>
        <div class="fw-bold text-base-color mb-3 text-center">
            <span>{{ kmRange[0] }} км. - </span>
            <span>{{ kmRange[1] }} км.</span>
        </div>
        <Slider v-model="kmRange"
                :max="200000"
                :min="0"
                :step="5000"
                :tooltips="false"
                :lazy="false"
                class="advanced-filter-range-slider"
                @change="handleKmSlider"
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
        let kmRange = ref([]);

        if (isUndefined(route.query.km)) {
            kmRange.value[0] = 0;
            kmRange.value[1] = 200000;
        } else {
            const splitRouteParams = route.query.km.split('-');

            kmRange.value[0] = Number(splitRouteParams[0]);
            kmRange.value[1] = Number(splitRouteParams[1]);
        }

        function handleKmSlider() {
            router.push({
                name: route.name,
                query: {...route.query, km: kmRange.value[0] + '-' + kmRange.value[1]}
            });
        }

        return {
            kmRange,
            handleKmSlider
        }
    }
}
</script>
