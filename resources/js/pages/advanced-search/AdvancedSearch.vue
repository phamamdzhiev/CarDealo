<template>
    <div class="container-xxl py-3">
        <div class="row gx-1">
            <div class="col-lg-3">
                <div class="p-2 advanced-filters">
                    <h5 class="fw-bold mb-3">Търсене по филтри</h5>
                    <BudgetFilter></BudgetFilter>
                    <YearFilter></YearFilter>
                    <KmFilter></KmFilter>
                    <FuelFilter></FuelFilter>
                    <TransmissionFilter></TransmissionFilter>
                    <ColorFilter></ColorFilter>
                </div>
            </div>
            <div class="col-lg-9 p-2">
                <div class="d-grid">
                    <CarSingleItem></CarSingleItem>
                    <CarSingleItem></CarSingleItem>
                    <CarSingleItem></CarSingleItem>
                    <CarSingleItem></CarSingleItem>
                    <CarSingleItem></CarSingleItem>
                    <CarSingleItem></CarSingleItem>
                    <CarSingleItem></CarSingleItem>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import {onMounted, reactive} from "vue";
import {useRoute} from "vue-router";
import CarSingleItem from "../../components/car/CarSingleItem";

//Filters
import BudgetFilter from "./partials/BudgetFilter";
import YearFilter from "./partials/YearFilter";
import KmFilter from "./partials/KmFilter";
import FuelFilter from "./partials/FuelFilter";
import TransmissionFilter from "./partials/TransmissionFilter";
import ColorFilter from "./partials/ColorFilter";

export default {
    name: "AdvancedSearch",
    components: {
        BudgetFilter,
        YearFilter,
        KmFilter,
        FuelFilter,
        TransmissionFilter,
        ColorFilter,
        CarSingleItem
    },
    setup() {
        const router = useRoute();

        // onMounted(() => {
        //     console.log('Mounted', router.query)
        // });
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
