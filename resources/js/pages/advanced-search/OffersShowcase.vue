<template>
    <div class="container-xxl py-3">
        <router-link class="mb-4 d-inline-block" :to="{name: 'advanced.filters'}">
            <i class="fa-brands fa-searchengin fs-5"></i>
            Коригирай търсенето
        </router-link>
        <spinner v-if="isLoading"/>
        <template v-else-if="offers">
            <div class="d-grid">
                <template v-for="offer in offers.data" :key="offer.uid">
                    <CarSingleItem :offer="offer"></CarSingleItem>
                </template>
            </div>
<!--            <observer @intersect="fetchData"/>-->
        </template>
        <div v-else>Няма намерени обяви</div>
        <Pagination v-if="offers" :data="offers" @pagination-change-page="fetchData" />
    </div>
</template>

<script>
import axios from "axios";
import {onMounted, ref, watch, computed, inject} from "vue";
import CarSingleItem from "../../components/car/CarSingleItem";
import {useRoute, useRouter} from "vue-router";
import Observer from "../../components/ui/base/Observer";
import {useStore} from "vuex";

export default {
    name: "OffersShowcase",
    components: {
        CarSingleItem,
        Observer,
    },
    setup() {
        // const offers = ref([]);
        const isLoading = ref(false);
        const route = useRoute();
        const router = useRouter();
        const store = useStore();
        const offers = ref(null)

        // watch(() => route.query, () => {
        //     fetchData()
        // });

        const window = inject('window');
        const apiCallStore = computed(() => {
            return store.getters['apicallstore/getLazyLoadOffersShowcase'];
        });

        console.log(apiCallStore.value)


        async function fetchData(page = 1) {
            await router.push({name:'offers.showcase', query: {...route.query, page: page}});

            try {
                isLoading.value = true;
                const res = await axios.get('/fetch/offers?page=' + page + '&' + window.location.search);
                isLoading.value = false
                if (res.data) {
                    console.log(res.data)
                    // store.commit('apicallstore/setLazyLoadOffersShowcase', res.data);
                    offers.value = res.data;
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
