<template>
    <div class="home">
        <base-carousel
            :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/compare-cars.jpg'"
            height="450"
        />
    </div>
   <div class="container-xxl">
       <simple-search heading="Бързо търсене"/>
       <page-heading heading="Последно добавени"/>
       <base-card>
           <used-cars-vue3-carousel v-if="data.length > 0" :vehicles="data"/>
       </base-card>
   </div>
</template>

<script>
import BaseCard from "../components/ui/base/BaseCard";
import BaseCarousel from "../components/ui/base/BaseCarousel.vue";
import SimpleSearch from "../components/simple-search/SimpleSearch";
import {useFetcher} from "../composables/fetcher";
import UsedCarsVue3Carousel from "../components/ui/UsedCarsVue3Carousel";
import PageHeading from "../components/layout/PageHeading";

export default {
    name: "Home",
    components: {
        BaseCarousel,
        SimpleSearch,
        UsedCarsVue3Carousel,
        BaseCard,
        PageHeading
    },
    setup() {
        const {fetch: data} = useFetcher('get.offers', null, false);

        return {
            data
        }
    }
};
</script>
