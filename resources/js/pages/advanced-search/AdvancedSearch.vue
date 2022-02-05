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
                <div v-if="isLoading">
                    Зареждане
                </div>
                <div class="d-grid" v-else-if="offers">
                    <CarSingleItem v-for="offer in offers" :offer="offer"></CarSingleItem>
                </div>
                <div v-else>Няма намерени обяви</div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import {onMounted, reactive, ref} from "vue";
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
        let offers = ref(null);
        let isLoading = ref(false);

        async function fetchData() {
            try {
                isLoading.value = true;
                const res = await axios.get('/fetch/offers');
                isLoading.value = false
                if (res.data.length > 0) {
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
            isLoading
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
