<template>
    <div>
        <base-carousel
            :height="400"
            :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/used-car-hero-img.jpg'"
        >
            <template #simpleSearch>
                <h3><i>...render simple search component here...</i></h3>
            </template>
        </base-carousel>

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
            <BaseGrid :items="cities"></BaseGrid>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили според бюджет</h5>
            <Tabs :options="{ useUrlFragment: false }" @changed="setBudgetTab">
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
            <SeeAll :message="`Виж всички ${selectedBudgetTab}`"></SeeAll>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили по каросерия</h5>
            <Tabs :options="{ useUrlFragment: false }" @changed="setBodyTypeTab">
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
            <SeeAll :message="`Виж всички автомобили ${selectedBodyTypeTab}`"></SeeAll>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Доверени автомобили по марка</h5>
            <hr/>
            <BaseGrid :items="brands"></BaseGrid>
        </BaseCard>

        <div class="container-xxl">
            <div class="row">
                <div class="col-md-6 ps-0">
                    <div class="base-card d-flex justify-content-between">
                        <div class="py-3">
                            <h4 class="mb-0 fw-bold">Продай своя автомобил бързо</h4>
                            <p class="mb-0 text-normal-gray">Директно от вкъщи</p>
                            <a href="/" class="mt-4 d-block text-link-blue">Продай своя автомобил тук</a>
                        </div>
                        <img
                            width="130"
                            height="130"
                            src="https://ik.imagekit.io/gaicl5qj9hl/tr:w-130,h-130/icons/sell-car_vNZwdICyt.png?ik-sdk-version=javascript-1.4.3&updatedAt=1643796442201"
                            alt=""
                        />
                    </div>
                </div>
                <div class="col-md-6 pe-0">
                    <div class="base-card d-flex justify-content-between">
                        <div class="py-3">
                            <h4 class="mb-0 fw-bold">Сравни автомобилни марки</h4>
                            <p class="mb-0 text-normal-gray ">Избери правилният за теб сега</p>
                            <a href="/" class="mt-4 d-block text-link-blue">Сравни автомобили тук</a>
                        </div>
                        <img
                            width="130"
                            height="130"
                            src="https://ik.imagekit.io/gaicl5qj9hl/tr:w-130,h-130/icons/compare_bAgMtQMPc.png?ik-sdk-version=javascript-1.4.3&updatedAt=1643796387286"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>

        <BaseCard>
            <h5 class="fw-bold">Автомобили по вид на двигателя</h5>
            <hr/>
            <BaseGrid :items="engines"></BaseGrid>
        </BaseCard>
    </div>
</template>
<script>
import BaseCarousel from "../../components/ui/base/BaseCarousel";
import BaseCard from "../../components/ui/base/BaseCard";

import UsedCarsVue3Carousel from "./sliders/UsedCarsVue3Carousel";
import BaseGrid from "../../components/ui/base/BaseGrid";
import {reactive, ref} from "vue";
import {Tab, Tabs} from 'vue3-tabs-component';
import assetMixin from '../../mixins/asset';
import SeeAll from "./partials/SeeAll";


export default {
    components: {
        BaseCarousel,
        BaseCard,
        BaseGrid,
        UsedCarsVue3Carousel,
        SeeAll,
        Tab,
        Tabs
    },
    mixins: [assetMixin],
    setup() {
        const cities = [
            {name: 'София'},
            {name: 'Пловдив'},
            {name: 'Варна'},
            {name: 'Бургас'},
            {name: 'Русе'},
            {name: 'Стара Загора'},
            {name: 'Плевен'},
            {name: 'Ямбол'},
            {name: 'Пазарджик'},
            {name: 'Благоевград'},
            {name: 'Велико Търново'},
            {name: 'Видин'},
        ];
        const brands = [
            {name: 'Audi'},
            {name: 'Ford'},
            {name: 'Mercedes-Benz'},
            {name: 'Kia'},
        ];
        const engines = [
            {name: 'Benz'},
            {name: 'Dizel'},
            {name: 'GAs'},
            {name: 'Hibris'},
        ];

        let selectedBudgetTab = ref(null);
        let selectedBodyTypeTab = ref(null);

        function setBudgetTab(data) {
            selectedBudgetTab.value = data.tab.name;
        }

        function setBodyTypeTab(data) {
            selectedBodyTypeTab.value = data.tab.name;
        }

        return {
            cities,
            brands,
            engines,
            setBudgetTab,
            setBodyTypeTab,
            selectedBudgetTab,
            selectedBodyTypeTab
        }
    }
};
</script>

