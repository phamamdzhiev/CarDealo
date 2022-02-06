<template>
    <div v-if="isLoading">
        Зареждане
    </div>
    <BaseCard v-else>
        <h5 class="fw-bold">Автомобили по каросерия</h5>
        <Tabs :options="{ useUrlFragment: false }" @changed="setBodyTypeTab">
            <Tab name="Хечбек">
                <UsedCarsVue3Carousel :car-data="bodyTypes"></UsedCarsVue3Carousel>
            </Tab>
            <Tab name="Седан">
                <UsedCarsVue3Carousel :car-data="bodyTypes"></UsedCarsVue3Carousel>
            </Tab>
            <Tab name="Комби">
                <UsedCarsVue3Carousel :car-data="bodyTypes"></UsedCarsVue3Carousel>
            </Tab>
            <Tab name="SUV">
                <UsedCarsVue3Carousel :car-data="bodyTypes"></UsedCarsVue3Carousel>
            </Tab>
            <Tab name="Купе">
                <UsedCarsVue3Carousel :car-data="bodyTypes"></UsedCarsVue3Carousel>
            </Tab>
        </Tabs>
        <SeeAll :message="`Виж всички автомобили ${selectedBodyTypeTab}`"></SeeAll>
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
    name: "BodyTypeCars",
    components: {
        BaseCard,
        UsedCarsVue3Carousel,
        SeeAll,
        Tab,
        Tabs
    },
    setup() {
        let isLoading = ref(false);
        let selectedBodyTypeTab = ref(null);
        let bodyTypes = ref(null);

        function setBodyTypeTab(data) {
            selectedBodyTypeTab.value = data.tab.name;
        }

        async function getBodyTypes() {
            try {
                isLoading.value = true;
                const res = await axios.get('offers/fetch/recommended');
                isLoading.value = false;
                bodyTypes.value = res.data;
            } catch (e) {
                console.log(e, 'Could not fetch body types');
            }
        }

        onMounted(async () => {
            await getBodyTypes();
        });

        return {
            isLoading,
            setBodyTypeTab,
            selectedBodyTypeTab,
            bodyTypes
        }
    }
}
</script>

<style scoped>

</style>
