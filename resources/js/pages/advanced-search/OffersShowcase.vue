<template>
    <div class="container-xxl py-3">
        <router-link class="mb-4 d-inline-block" :to="{ name: 'advanced.filters' }">
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
        <Pagination v-if="offers" :data="offers" @pagination-change-page="fetchData"/>
    </div>
</template>

<script>
import axios from "axios";
import {computed, onMounted, ref, watch} from "vue";
import CarSingleItem from "../../components/car/CarSingleItem";
import {useRoute, useRouter} from "vue-router";
// import Observer from "../../components/ui/base/Observer";

export default {
    name: "OffersShowcase",
    components: {
        CarSingleItem,
    },
    setup() {
        const isLoading = ref(false);
        const route = useRoute();
        const router = useRouter();
        const offers = ref(null)

        watch(() => route.query.category, () => {
            fetchData() //don't pass page param so that it goes always to page 1 when categories are changes
        });

        async function fetchData(page = 1) {
            const params = {
                ...route.query,
                page
            }

            // const a = await router.push({name: 'offers.showcase', query: params});
            // console.log(isNavigationFailure(a));
            // await router.replace({query: params});

            try {
                isLoading.value = true;
                const res =
                    await axios.get('/fetch/offers', {params});
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
