<template>
    <div class="container-xxl py-3">
        <div class="row gx-1">
            <div class="col-lg-3">
                <div class="p-2 advanced-filters">
                    <h5 class="fw-bold mb-3">Търсене по филтри</h5>
                    <VehicleCategoryFilter @updateQueryParams="fetchData"/>
                    <VehicleTypeFilter @updateQueryParams="fetchData"/>
                    <BrandFilter @updateQueryParams="fetchData"/>
                    <BudgetFilter @updateQueryParams="fetchData"/>
                    <YearFilter @updateQueryParams="fetchData"/>
                    <KmFilter @updateQueryParams="fetchData"/>
                    <FuelFilter @updateQueryParams="fetchData"/>
                    <TransmissionFilter @updateQueryParams="fetchData"/>
                    <RegionFilter  @updateQueryParams="fetchData"/>
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
            fetchData
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
