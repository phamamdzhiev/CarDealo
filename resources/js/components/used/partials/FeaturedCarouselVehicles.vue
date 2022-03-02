<template>
    <BaseCard>
        <h5 class="fw-bold">{{ heading }}</h5>
        <Tabs :options="{ useUrlFragment: false }" v-if="Object.keys(propsData).length > 1">
            <Tab v-for="item in propsData" :name="item.tabName">
                <UsedCarsVue3Carousel :vehicles="item.data"></UsedCarsVue3Carousel>
                <SeeAll :message="`Виж всички ${item.tabName}`"></SeeAll>
            </Tab>
        </Tabs>
        <UsedCarsVue3Carousel v-else :vehicles="propsData.data"></UsedCarsVue3Carousel>
    </BaseCard>
</template>

<script>
import BaseCard from "../../ui/base/BaseCard";
import UsedCarsVue3Carousel from "../../ui/UsedCarsVue3Carousel";
import {Tab, Tabs} from "vue3-tabs-component";
import SeeAll from "./SeeAll";


export default {
    name: "FeaturedCarouselVehicles",
    components: {
        BaseCard,
        UsedCarsVue3Carousel,
        Tab,
        Tabs,
        SeeAll
    },
    props: {
        heading: {
            type: String,
            required: true
        },
        propsData: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
