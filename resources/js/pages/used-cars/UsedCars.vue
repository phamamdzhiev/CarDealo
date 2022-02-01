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
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div style="outline: 2px solid #dc3545">
                        <h4>Sell your car</h4>
                        <p class="mb-0">Lorem ipsum dolor ismet</p>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div style="outline: 2px solid #0a53be">
                        <h4>Compare cars</h4>
                        <p class="mb-0">Lorem ipsum dolor ismet</p>
                    </div>
                </div>
            </div>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили по вид на двигателя</h5>
            <hr />
            <PopularEngines></PopularEngines>
        </BaseCard>
    </div>
</template>
<script>
import BaseCarousel from "../../components/ui/base/BaseCarousel";
import BaseCard from "../../components/ui/base/BaseCard";

import UsedCarsVue3Carousel from "./sliders/UsedCarsVue3Carousel";
import PopularCities from "./partials/PopularCities";
import PopularEngines from "./partials/PopularEngines";
import {reactive, ref} from "vue";
import {Tab, Tabs} from 'vue3-tabs-component';
import assetMixin from '../../mixins/asset';


export default {
    components: {
        BaseCarousel,
        BaseCard,
        PopularCities,
        PopularEngines,
        UsedCarsVue3Carousel,
        Tab,
        Tabs
    },
    mixins: [assetMixin],
    setup() {
    }
};
</script>

