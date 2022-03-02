<template>
    <div>
        <base-carousel
            :height="400"
            :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/used-car-hero-img.jpg'"
        >
            <div class="banner-heading mt-5">
                <div class="container">
                    <h1 class="text-white fw-bold mb-5" style="max-width:600px;">
                        Вашето търсене на надежден употребяван автомобил приключи!
                    </h1>
                </div>
            </div>
            <template #simpleSearch>
                <simple-search></simple-search>
            </template>
        </base-carousel>

        <Intro
            :intro="
            {heading: 'Упрот',
            body: 'Намерете пълен списък на сертифицирани употребявани автомобили в България. Можете да изберете коли втора употреба, като приложите филтри като местоположение, цена, тип каросерия, марка и т.н.'
            }"
        />

        <!--recommende-->


        <By
            :by="{heading: 'Автомобили в България по област BAY', byFeature: cities}"
        />
        <FeaturedCarouselVehicles
            heading="Автомобили според бюджет"
            :vehicles="budget"
        />

        <!--        <BodyTypeCars></BodyTypeCars>-->

        <By
            :by="{heading: 'Доверени автомобили по марка BAY', byFeature: brands}"
        />

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

        <By
            :by="{heading: 'Доверени по вид на двигателя', byFeature: engines}"
        />
    </div>
</template>
<script>
import BaseCarousel from "../../components/ui/base/BaseCarousel";
import assetMixin from '../../mixins/asset';
import SimpleSearch from "../../components/ui/SimpleSearch";
import VehicleAndValuationAd from "../../components/used/partials/VehicleAndValuationAd";
import axios from "axios";
import Intro from "../../components/used/partials/Intro";
import {onMounted, ref} from "vue";
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
        FeaturedCarouselVehicles
    },
    mixins: [assetMixin],
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

        const budget = {
            vehicles5000: {
                tabName: 'до 5000 лв',
                data: [
                    {name: 'Benz'},
                    {name: 'Dizel'},
                    {name: 'GAs'},
                    {name: 'Hibris'}
                ]
            },
            vehicles10000: {
                tabName: 'до 10 000 лв',
                data: [
                    {name: 'Benz', id: 2},
                    {name: 'Dizel', id: 2},
                    {name: 'GAs', id: 2},
                    {name: 'Hibris', id: 2}
                ]
            }
        };

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
            budget
        }
    }
};
</script>

