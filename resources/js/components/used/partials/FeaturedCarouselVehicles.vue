<template>
    <BaseCard>
        <h5 class="fw-bold">{{ heading }}</h5>
        <Tabs :options="{ useUrlFragment: false }">
            <Tab v-for="item in vehicles" :name="item.tabName">
                <UsedCarsVue3Carousel v-for="v in item.data" :vehicles="v"></UsedCarsVue3Carousel>
            </Tab>
        </Tabs>
        <!--        <SeeAll :message="`Виж всички ${selectedBudgetTab}`"></SeeAll>-->
    </BaseCard>
</template>

<script>
import BaseCard from "../../ui/base/BaseCard";
import UsedCarsVue3Carousel from "../../ui/UsedCarsVue3Carousel";
import {Tab, Tabs} from "vue3-tabs-component";

export default {
    name: "FeaturedCarouselVehicles",
    components: {
        BaseCard,
        UsedCarsVue3Carousel,
        Tab,
        Tabs
    },
    props: {
        heading: {
            type: String,
            required: true
        },
        vehicles: {
            required: true
        }
    }
}
</script>

<style scoped>

</style>
