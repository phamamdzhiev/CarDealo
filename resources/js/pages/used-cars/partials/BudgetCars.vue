<template>
    <div v-if="isLoading">
        Зареждане
    </div>
    <BaseCard v-else>
        <h5 class="fw-bold">Автомобили според бюджет</h5>
        <Tabs :options="{ useUrlFragment: false }" @changed="setBudgetTab">
            <Tab name="до 5000 лв.">
                <UsedCarsVue3Carousel v-if="budgetCars5000" :car-data="budgetCars5000"></UsedCarsVue3Carousel>
            </Tab>
            <Tab name="5000 - 10 000 лв.">
                <UsedCarsVue3Carousel v-if="budgetCars500010000" :car-data="budgetCars500010000"></UsedCarsVue3Carousel>
            </Tab>
        </Tabs>
        <SeeAll :message="`Виж всички ${selectedBudgetTab}`"></SeeAll>
    </BaseCard>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import UsedCarsVue3Carousel from "../sliders/UsedCarsVue3Carousel";
import SeeAll from "./SeeAll";
import {ref, onMounted} from "vue";
import {Tab, Tabs} from "vue3-tabs-component";
import axios from "axios";

export default {
    name: "BudgetCars",
    components: {
        BaseCard,
        UsedCarsVue3Carousel,
        SeeAll,
        Tab,
        Tabs
    },
    setup() {
        let selectedBudgetTab = ref(null);
        let isLoading = ref(false);
        let budgetCars5000 = ref(null);
        let budgetCars500010000 = ref(null);

        function setBudgetTab(data) {
            selectedBudgetTab.value = data.tab.name;
        }

        async function budget5000() {
            try {
                isLoading.value = true;
                const res = await axios.get('offers/fetch/recommended');
                isLoading.value = false;
                budgetCars5000.value = res.data;
            } catch (e) {
                console.log(e, 'Could not fetch budget cars');
            }
        }

        async function budget500010000() {
            try {
                isLoading.value = true;
                const res = await axios.get('offers/fetch/recommended');
                isLoading.value = false;
                budgetCars500010000.value = res.data;
            } catch (e) {
                console.log(e, 'Could not fetch budget cars');
            }
        }

        onMounted(async () => {
            await budget5000()
            await budget500010000()
        });

        return {
            setBudgetTab,
            selectedBudgetTab,
            budgetCars5000,
            budgetCars500010000,
            isLoading
        }
    }
}
</script>

<style scoped>

</style>
