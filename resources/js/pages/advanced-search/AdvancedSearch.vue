<template>
    <div class="container-xxl py-3">
        <router-link class="mb-4 d-inline-block" :to="{name: 'advanced.filters'}">Коригирай търсенето</router-link>
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
import {onMounted, ref} from "vue";
import CarSingleItem from "../../components/car/CarSingleItem";
import {useRoute} from "vue-router";
import {isUndefined} from "lodash";

export default {
    name: "AdvancedSearch",
    components: {
        CarSingleItem,
    },
    inject: ['window'],
    setup() {
        const offers = ref([]);
        const isLoading = ref(false);
        const route = useRoute();
        const vehicleTypeID = ref(null);

        function fetchVehicleCategoriesAndBrands(typeID) {
            vehicleTypeID.value = typeID;
            // const res = await axios.get(`vehicle/fetch/vehicle-type/${typeID}/category`);
            // const res1 = await axios.get(`vehicle/fetch/brands/${typeID}/1`);
            // if (res1.data) {
            //     vehicleBrands.value = [];
            //     res1.data.forEach((element) => {
            //         vehicleBrands.value.push({label: element.name, value: element.id});
            //     });
            // }
            //
            // if (res.data) {
            //     vehicleCategories.value = [];
            //     res.data.forEach((element) => {
            //         vehicleCategories.value.push({label: element.name, value: element.id});
            //     });
            // }
        }

        async function fetchData() {
            try {
                isLoading.value = true;
                const res = await axios.get('/fetch/offers' + window.location.search);
                isLoading.value = false
                if (res.data) {
                    offers.value = res.data;
                    offers.value.forEach(e => console.log(e));
                }
            } catch (e) {
                console.log(e, 'fetch offers failed');
            }
        }

        onMounted(() => {
            fetchData();
            if (!isUndefined(route.query.type)) {
                fetchVehicleCategoriesAndBrands(route.query.type)
            }
        });


        return {
            offers,
            isLoading,
            fetchData,
            fetchVehicleCategoriesAndBrands,
            vehicleTypeID
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
