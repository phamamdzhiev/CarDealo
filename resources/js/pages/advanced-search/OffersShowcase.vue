<template>
    <div class="container-xxl py-3">
        <router-link class="mb-4 d-inline-block" :to="{name: 'advanced.filters'}">
            <i class="fa-brands fa-searchengin fs-5"></i>
            Коригирай търсенето
        </router-link>
        <spinner v-if="isLoading"/>
        <div class="d-grid" v-else-if="offers.length > 0">
            <template v-for="offer in offers" :key="offer.uid">
                <CarSingleItem :offer="offer"></CarSingleItem>
            </template>
        </div>
        <div v-else>Няма намерени обяви</div>
    </div>
</template>

<script>
import axios from "axios";
import {onMounted, ref, watch} from "vue";
import CarSingleItem from "../../components/car/CarSingleItem";
import {useRoute} from "vue-router";

export default {
    name: "OffersShowcase",
    components: {
        CarSingleItem,
    },
    inject: ['window'],
    setup() {
        const offers = ref([]);
        const isLoading = ref(false);
        const route = useRoute();

        watch(() => route.query, () => {
            fetchData()
        });

        async function fetchData() {
            try {
                isLoading.value = true;
                const res = await axios.get('/fetch/offers' + window.location.search);
                isLoading.value = false
                if (res.data) {
                    offers.value = res.data;
                }
            } catch (e) {
                console.log(e, 'fetch offers failed');
            }
        }

        onMounted(() => {
            fetchData();
        });


        return {
            offers,
            isLoading,
            fetchData,
        }
    }
}
</script>

<style scoped>
.d-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    justify-content: center;
    gap: 10px 15px;
}
</style>
