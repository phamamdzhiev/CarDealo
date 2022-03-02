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

        <BaseCard>
            <h5 class="fw-bold">Употребявани автомобили</h5>
            <p>
                Намерете пълен списък на сертифицирани употребявани автомобили в
                България. Можете да изберете коли втора употреба, като приложите филтри
                като местоположение, цена, тип каросерия, марка и т.н.
            </p>
        </BaseCard>

        <RecommendedCars></RecommendedCars>

        <BaseCard>
            <h5 class="fw-bold">Автомобили в България по област</h5>
            <hr/>
            <div v-if="cities">
                <BaseGrid :items="cities"></BaseGrid>
            </div>
        </BaseCard>

        <BudgetCars></BudgetCars>

        <BodyTypeCars></BodyTypeCars>

        <BaseCard>
            <h5 class="fw-bold">Доверени автомобили по марка</h5>
            <hr/>
            <div v-if="brands">
                <BaseGrid :items="brands"></BaseGrid>
            </div>
        </BaseCard>

        <div class="container-xxl">
            <div class="row">
                <div class="col-md-6 ps-0">
                    <div class="base-card d-flex justify-content-between">
                        <div class="py-3">
                            <h5 class="mb-0 fw-bold">Продай своя автомобил бързо</h5>
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
                            <h5 class="mb-0 fw-bold">Сравни автомобилни марки</h5>
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
            <div v-if="engines">
                <BaseGrid :items="engines"></BaseGrid>
            </div>
        </BaseCard>
    </div>
</template>
<script>
import BaseCarousel from "../../components/ui/base/BaseCarousel";
import BaseCard from "../../components/ui/base/BaseCard";
import BaseGrid from "../../components/ui/base/BaseGrid";
import assetMixin from '../../mixins/asset';
import SimpleSearch from "../../components/ui/SimpleSearch";
import RecommendedCars from "./partials/RecommendedCars";
import BudgetCars from "./partials/BudgetCars";
import BodyTypeCars from "./partials/BodyTypeCars";
import axios from "axios";
import {onMounted, ref} from "vue";


export default {
    name:'usedBuses',
    components: {
        BaseCarousel,
        BaseCard,
        BaseGrid,
        SimpleSearch,
        RecommendedCars,
        BudgetCars,
        BodyTypeCars
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
        }
    }
};
</script>

