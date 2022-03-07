<template>
    <div>
        <base-carousel
            height="400"
            :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/used-car-hero-img.jpg'"
            heading="Вашето търсене на надежден употребяван автомобил приключи!"
        >
            <template #simpleSearch>
                <simple-search></simple-search>
            </template>
        </base-carousel>

        <Intro
            :intro="
            {heading: 'Употребявани автомобили в България',
            body: 'Намерете пълен списък на сертифицирани употребявани автомобили в България. Можете да изберете коли втора употреба, като приложите филтри като местоположение, цена, тип каросерия, марка и т.н.'
            }"
        />

        <FeaturedCarouselVehicles heading="Препоръчани автомобили" :props-data="recommended"/>

        <By :by="{heading: 'Автомобили в България по област', byFeature: cities}"/>

        <FeaturedCarouselVehicles heading="Автомобили според бюджет" :props-data="budget"/>

        <FeaturedCarouselVehicles heading="Автомобили по тип на каросерията" :props-data="bodyType"/>

        <By :by="{heading: 'Автомобили по марка', byFeature: brands}"/>

        <div class="container-xxl">
            <div class="row">
                <div class="col-md-6 ps-0">
                    <VehicleAndValuationAd
                        sub-heading="Директно от вкъщи"
                        heading="Продай своя автомобил бързо"
                        :link="{linkHref: '/', linkLabel: 'Продай своя автомобил тук'}"
                        image="https://ik.imagekit.io/gaicl5qj9hl/tr:w-130,h-130/icons/sell-car_vNZwdICyt.png?ik-sdk-version=javascript-1.4.3&updatedAt=1643796442201"
                    />
                </div>
                <div class="col-md-6 pe-0">
                    <VehicleAndValuationAd
                        sub-heading="Сравни автомобилни марки"
                        heading="Избери правилният за теб сега"
                        :link="{linkHref: '/', linkLabel: 'Сравни автомобили тук'}"
                        image="https://ik.imagekit.io/gaicl5qj9hl/tr:w-130,h-130/icons/compare_bAgMtQMPc.png?ik-sdk-version=javascript-1.4.3&updatedAt=1643796387286"
                    />
                </div>
            </div>
        </div>

        <By :by="{heading: 'Автомобили вид на двигателя', byFeature: engines}"/>
    </div>
</template>
<script>
import BaseCarousel from "../../components/ui/base/BaseCarousel";
import SimpleSearch from "../../components/ui/SimpleSearch";
import VehicleAndValuationAd from "../../components/used/partials/VehicleAndValuationAd";
import axios from "axios";
import Intro from "../../components/used/partials/Intro";
import {onMounted, reactive, ref} from "vue";
import By from "../../components/used/partials/By";
import FeaturedCarouselVehicles from "../../components/used/partials/FeaturedCarouselVehicles";

export default {
    name: 'usedCars',
    components: {
        Intro,
        By,
        BaseCarousel,
        SimpleSearch,
        VehicleAndValuationAd,
        FeaturedCarouselVehicles,
    },
    setup() {
        const cities = ref(null);

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

        const recommended = reactive({
            data: [
                {name: 'Benz'},
                {name: 'Dizel'},
                {name: 'GAs'},
                {name: 'Hibris'}
            ]
        });

        const budget = reactive({
            vehicles5000: {
                tabName: 'до 5000лв.',
                data: [
                    {name: 'Benz'},
                    {name: 'Dizel'},
                    {name: 'GAs'},
                    {name: 'Hibris'}
                ]
            },
            vehicles10000: {
                tabName: 'от 5000лв. до 10 000лв.',
                data: []
            },
        });

        const bodyType = reactive({
            vehiclesCombi: {
                tabName: 'Комби',
                data: [
                    {name: 'Benz'},
                    {name: 'Dizel'},
                    {name: 'GAs'},
                    {name: 'Hibris'}
                ]
            },
            vehiclesSedan: {
                tabName: 'Седан',
                data: []
            },
        });


        async function fetchPopularRegions() {
            try {
                const res = await axios.get('fetch/popular/regions');
                if (res.data.success) {
                    cities.value = res.data.data;
                }
            } catch (e) {
                console.log('Unable to fetch popular regions', e.response);
            }
        }

        onMounted(() => {
            fetchPopularRegions()
        });

        return {
            cities,
            brands,
            engines,
            budget,
            bodyType,
            recommended
        }
    }
};
</script>

