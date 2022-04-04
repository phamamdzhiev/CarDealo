<template>
    <div class="container-xxl py-3">
        <router-link class="mb-4 d-inline-block" :to="{name: 'advanced.filters'}">
            <i class="fa-brands fa-searchengin fs-5"></i>
            Коригирай търсенето
        </router-link>
        <template v-if="offers.length > 0">
            <div class="d-grid">
                <template v-for="(offer, i) in offers" :key="offer.uid">
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                    <CarSingleItem :offer="offer"></CarSingleItem>
                </template>
            </div>
            <Pagination :data="offers" @pagination-change-page="fetchData" />
<!--            <observer @intersect="fetchData"/>-->
            <spinner v-if="isLoading"/>
        </template>
        <div v-else>Няма намерени обяви</div>
    </div>
</template>

<script>
import axios from "axios";
import {onMounted, ref, watch, computed} from "vue";
import CarSingleItem from "../../components/car/CarSingleItem";
import {useRoute} from "vue-router";
import Observer from "../../components/ui/base/Observer";
import {useStore} from "vuex";

export default {
    name: "OffersShowcase",
    components: {
        CarSingleItem,
        Observer
    },
    inject: ['window'],
    setup() {
        // const offers = ref([]);
        const isLoading = ref(false);
        const route = useRoute();
        const store = useStore();

        // watch(() => route.query, () => {
        //     fetchData()
        // });

        const apiCallStore = computed(() => {
            return store.getters['apicallstore/getLazyLoadOffersShowcase'];
        });


        async function fetchData(page = 1) {
            console.log(
                page
            )
            try {
                isLoading.value = true;
                const res = await axios.get('/fetch/offers' + window.location.search);
                isLoading.value = false
                if (res.data) {
                    store.commit('apicallstore/setLazyLoadOffersShowcase', res.data);
                    // offers.value.push(...res.data);
                }
            } catch (e) {
                console.log(e, 'fetch offers failed');
            }
        }

        onMounted(() => {
            // if (apiCallStore.value.length === 0) {
                fetchData();
            // }

        });


        return {
            offers: apiCallStore,
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
