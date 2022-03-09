<template>
    <div class="container-xxl py-3">
        <div class="row gx-1">
            <div class="col-lg-3">
                <div class="p-2 advanced-filters">
                    <h5 class="fw-bold mb-3">Търсене по филтри</h5>
                    <VehicleTypeFilter :types="vehicleTypes"
                                       @fetchCategory="fetchVehicleCategoriesAndBrands" @updateQueryParams="fetchData"/>
                    <VehicleCategoryFilter v-if="vehicleCategories.length > 0" :categories="vehicleCategories"
                                           @updateQueryParams="fetchData"/>
                    <BrandFilter v-if="vehicleBrands.length > 0" :brands="vehicleBrands"
                                 @updateQueryParams="fetchData"/>
                    <BudgetFilter @updateQueryParams="fetchData"/>
                    <YearFilter @updateQueryParams="fetchData"/>
                    <KmFilter @updateQueryParams="fetchData"/>
                    <FuelFilter @updateQueryParams="fetchData"/>
                    <TransmissionFilter @updateQueryParams="fetchData"/>
                    <RegionFilter v-if="regions.length > 0" :regions="regions" @updateQueryParams="fetchData"/>
                    <ColorFilter @updateQueryParams="fetchData"/>
                </div>
            </div>
            <div class="col-lg-9 p-2">
                <spinner v-if="isLoading"/>
                <div class="d-grid" v-else-if="offers.length > 0">
                    <CarSingleItem v-for="offer in offers" :offer="offer"></CarSingleItem>
                </div>
                <div v-else>Няма намерени обяви</div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import {onMounted, ref} from "vue";
import CarSingleItem from "../../components/car/CarSingleItem";

//Filters
import BrandFilter from "./partials/BrandFilter";
import BudgetFilter from "./partials/BudgetFilter";
import YearFilter from "./partials/YearFilter";
import KmFilter from "./partials/KmFilter";
import FuelFilter from "./partials/FuelFilter";
import TransmissionFilter from "./partials/TransmissionFilter";
import ColorFilter from "./partials/ColorFilter";
import VehicleCategoryFilter from "./partials/VehicleCategoryFilter";
import VehicleTypeFilter from "./partials/VehicleTypeFilter";
import RegionFilter from "./partials/RegionFilter";
import {useRoute} from "vue-router";
import {isUndefined} from "lodash";

export default {
    name: "AdvancedSearch",
    components: {
        VehicleCategoryFilter,
        VehicleTypeFilter,
        BrandFilter,
        BudgetFilter,
        YearFilter,
        KmFilter,
        FuelFilter,
        TransmissionFilter,
        ColorFilter,
        CarSingleItem,
        RegionFilter
    },
    inject: ['window'],
    setup() {
        let offers = ref([]);
        let isLoading = ref(false);
        const route = useRoute();
        const vehicleTypes = ref([]);
        const vehicleCategories = ref([]);
        const vehicleBrands = ref([]);
        const regions = ref([]);

        async function fetchVehicleTypes() {
            const res = await axios.get('vehicle/fetch/vehicle-types');
            if (res.data) {
                vehicleTypes.value = [];
                res.data.forEach((element) => {
                    vehicleTypes.value.push({label: element.name, value: element.id});
                });
            }
        }

        async function fetchVehicleCategoriesAndBrands(id) {
            const res = await axios.get(`vehicle/fetch/vehicle-type/${id}/category`);
            const res1 = await axios.get(`vehicle/fetch/brands/${id}/1`);
            if (res1.data) {
                vehicleBrands.value = [];
                res1.data.forEach((element) => {
                    vehicleBrands.value.push({label: element.name, value: element.id});
                });
            }

            if (res.data) {
                vehicleCategories.value = [];
                res.data.forEach((element) => {
                    vehicleCategories.value.push({label: element.name, value: element.id});
                });
            }
        }

        async function fetchRegions() {
            const res = await axios.get('fetch/regions');
            if (res.data.data) {
                regions.value = [];
                res.data.data.forEach((element) => {
                    regions.value.push({label: element.name, value: element.id});
                });
            }
        }

        async function fetchData() {
            try {
                isLoading.value = true;
                const res = await axios.get('/fetch/offers' + window.location.search);
                isLoading.value = false
                if (res.data) {
                    offers.value = res.data;
                    console.log('Offers', offers.value);

                }
            } catch (e) {
                console.log(e, 'fetch offers failed');
            }
        }

        onMounted(() => {
            fetchData();
            fetchVehicleTypes();
            fetchRegions();

            if (!isUndefined(route.query.type)) {
                fetchVehicleCategoriesAndBrands(route.query.type)
            }
        });


        return {
            offers,
            isLoading,
            fetchData,
            fetchVehicleCategoriesAndBrands,
            vehicleTypes,
            vehicleCategories,
            vehicleBrands,
            regions
        }
    }
}
</script>

<style scoped>
.d-grid {
    grid-template-columns: repeat(auto-fill, minmax(235px, 1fr));
    justify-content: center;
    gap: 10px 15px;
}
</style>
