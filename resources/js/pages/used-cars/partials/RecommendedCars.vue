<template>
    <BaseCard>
        <h5 class="fw-bold">Препоръчани автомобили за теб</h5>
        <hr/>
        <div v-if="isLoading">
            Зареждане
        </div>
        <UsedCarsVue3Carousel v-if="recommendedCars" :carData="recommendedCars"></UsedCarsVue3Carousel>

    </BaseCard>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import UsedCarsVue3Carousel from "../sliders/UsedCarsVue3Carousel";
import {onMounted, ref} from "vue";
import axios from "axios";

export default {
    name: "RecommendedCars",
    components: {
        UsedCarsVue3Carousel,
        BaseCard
    },

    setup() {
        let recommendedCars = ref(null);
        let isLoading = ref(false);

        onMounted(async () => {
            try {
                isLoading.value = true;
                const res = await axios.get('offers/fetch/recommended');
                isLoading.value = false;
                recommendedCars.value = res.data;
            } catch (e) {
                console.log(e, 'Could not fetch recommended cars');
            }
        });


        return {
            recommendedCars,
            isLoading
        }
    }
}
</script>

<style scoped>

</style>
