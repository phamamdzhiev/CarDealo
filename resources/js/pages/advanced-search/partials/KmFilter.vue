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

        kmRange.value[0] = isUndefined(route.query.kmMin) ? 0 : route.query.kmMin;
        kmRange.value[1] = isUndefined(route.query.kmMax) ? 200000 : route.query.kmMax;

        function handleKmSlider() {
            router.push({
                name: route.name,
                query: {
                    ...route.query,
                    kmMin: kmRange.value[0],
                    kmMax: kmRange.value[1]
                }
            });
        }

        return {
            kmRange,
            handleKmSlider
        }
    }
}
</script>
