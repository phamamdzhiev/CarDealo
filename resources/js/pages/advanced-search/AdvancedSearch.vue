<template>
    <div class="container-xxl py-3">
        <div class="row gx-1">
            <div class="col-lg-3">
                <div style="height: 400px;" class="p-2 advanced-filters">
                    <h5 class="fw-bold mb-3">Търсене по филтри</h5>
                    <BudgetFilter></BudgetFilter>
                    <BudgetFilter></BudgetFilter>
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

export default {
    name: "AdvancedSearch",
    components: {
        BudgetFilter,
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
