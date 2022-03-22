<template>
    <div class="home">
        <base-carousel
            :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/compare-cars.jpg'"
            height="450"
        />
    </div>
    <simple-search heading="Бързо търсене"/>
    <!--    <FeaturedCarouselVehicles heading="Препоръчани автомобили" :props-data="recommended"/>-->
</template>

<script>
import BaseCarousel from "../components/ui/base/BaseCarousel.vue";
import FeaturedCarouselVehicles from "../components/used/partials/FeaturedCarouselVehicles";
import {reactive} from "vue";
import BaseCard from "../components/ui/base/BaseCard";
import SimpleSearch from "../components/simple-search/SimpleSearch";

export default {
    name: "Home",
    components: {
        BaseCard,
        BaseCarousel,
        FeaturedCarouselVehicles,
        SimpleSearch
    },
    setup() {
        const recommended = reactive({
            data: [
                {name: 'Benz'},
                {name: 'Dizel'},
                {name: 'GAs'},
                {name: 'Hibris'}
            ]
        });

        return {
            recommended
        }
    }
};
</script>
