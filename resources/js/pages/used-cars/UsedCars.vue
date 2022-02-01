<template>
    <div>
        <base-carousel
            :height="400"
            :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/used-car-hero-img.jpg'"
        ></base-carousel>

        <BaseCard>
            <h5 class="fw-bold">Употребявани автомобили</h5>
            <p>
                Намерете пълен списък на сертифицирани употребявани автомобили в
                България. Можете да изберете коли втора употреба, като приложите филтри
                като местоположение, цена, тип каросерия, марка и т.н.
            </p>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Препоръчани автомобили за теб</h5>
            <hr/>
            <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили в България по град</h5>
            <hr/>
            <PopularCities></PopularCities>
        </BaseCard>


        <BaseCard>
            <h5 class="fw-bold">Автомобили според бюджет</h5>
            <Tabs :options="{ useUrlFragment: false }">
                <Tab name="до 5000 лв.">
                    <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
                </Tab>
                <Tab name="5000 - 10 000 лв.">
                    <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
                </Tab>
                <Tab name="над 10 000 лв.">
                    <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
                </Tab>
            </Tabs>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили по каросерия</h5>
            <Tabs :options="{ useUrlFragment: false }">
                <Tab name="Хечбек">
                    <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
                </Tab>
                <Tab name="Седан">
                    <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
                </Tab>
                <Tab name="Комби">
                    <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
                </Tab>
                <Tab name="SUV">
                    <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
                </Tab>
                <Tab name="Купе">
                    <UsedCarsVue3Carousel></UsedCarsVue3Carousel>
                </Tab>
            </Tabs>
        </BaseCard>
        <BaseCard>
            <!--            interna add-->
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили по вид на двигателя</h5>
        </BaseCard>
    </div>
</template>
<script>
import BaseCarousel from "../../components/ui/base/BaseCarousel.vue";
import BaseCard from "../../components/ui/base/BaseCard.vue";

import UsedCarsVue3Carousel from "./sliders/UsedCarsVue3Carousel";
import PopularCities from "./partials/PopularCities.vue";
import {reactive, ref} from "vue";
import {Tab, Tabs} from 'vue3-tabs-component';


export default {
    components: {
        BaseCarousel,
        BaseCard,
        PopularCities,
        UsedCarsVue3Carousel,
        Tab,
        Tabs
    },
    setup() {
    }
};
</script>

