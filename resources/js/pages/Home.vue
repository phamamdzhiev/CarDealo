<template>
  <div class="home d-md-block d-none">
    <base-carousel :bannerImage="asset('app-images/main-banner.png')" />
  </div>
  <div class="container-xxl">
    <simple-search heading="Бързо търсене" />
    <page-heading heading="Последно добавени" />
    <base-card>
      <used-cars-vue3-carousel v-if="data.length > 0" :vehicles="data" />
    </base-card>
  </div>
</template>

<script>
import BaseCard from "../components/ui/base/BaseCard";
import BaseCarousel from "../components/ui/base/BaseCarousel.vue";
import SimpleSearch from "../components/simple-search/SimpleSearch";
import UsedCarsVue3Carousel from "../components/ui/UsedCarsVue3Carousel";
import PageHeading from "../components/layout/PageHeading";
import assetMixin from "../composables/asset";
import { onMounted, ref } from "vue";
import axios from 'axios';

export default {
  name: "Home",
  components: {
    BaseCarousel,
    SimpleSearch,
    UsedCarsVue3Carousel,
    BaseCard,
    PageHeading,
  },
  mixins: [assetMixin],
  setup() {
    const data = ref([]);

    onMounted(async () => {
      try {
        const res = await axios.get("/fetch/offers");
        if (res.data) {
          data.value = res.data.data;
        }
      } catch (e) {
        console.log("cannot fetch offers homepage", e);
      }
    });

    return {
      data,
    };
  },
};
</script>
<style scoped>
.home {
  max-width: 1540px;
  margin: auto;
}
</style>
