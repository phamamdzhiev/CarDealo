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

        <FeaturedCarouselVehicles heading="Автомобили по тип на каросерията" :props-data="bodyType"
                                  v-if="Object.keys(bodyType).length > 0"/>

        <By :by="{heading: 'Автомобили по марка', byFeature: brands}"/>

        <div class="container-xxl">
            <div class="row">
                <div class="col-md-6 ps-0">
                    <VehicleAndValuationAd
                        sub-heading="Директно от вкъщи"
                        heading="Продай своя автомобил бързо"
                        link-href-name="upload"
                        link-label="Продай своя автомобил тук"
                        image="https://ik.imagekit.io/gaicl5qj9hl/tr:w-130,h-130/icons/sell-car_vNZwdICyt.png?ik-sdk-version=javascript-1.4.3&updatedAt=1643796442201"
                    />
                </div>
                <div class="col-md-6 pe-0">
                    <VehicleAndValuationAd
                        sub-heading="Сравни автомобилни марки"
                        heading="Избери правилният за теб сега"
                        link-href-name="Home"
                        link-label="Сравни автомобили тук"
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

        //change id of category here
        const category = 1;
        const cities = ref(null);

        const brands = ref(null);

        const engines = ref(null);

        const recommended = reactive({
            data: []
        });

        const budget = reactive({
            vehicles5000: {
                tabName: 'до 5000лв.',
                data: []
            },
            vehicles10000: {
                tabName: 'от 5000лв. до 10 000лв.',
                data: []
            },
        });

        const bodyType = reactive({});


        async function fetchPopularRegions() {
            try {
                const res = await axios.get('fetch/popular/regions');
                if (res.data.success) {
                    cities.value = res.data.data;
                }
            } catch (e) {
                console.error('Unable to fetch popular regions', e.response);
            }
        }

        async function fetchBrands() {
            try {
                const res = await axios.get('vehicle/fetch/brands/' + category + '/1');
                brands.value = res.data;
            } catch (e) {
                console.error('Unable to fetch popular brands', e.response);
            }
        }

        async function fetchEngines() {
            try {
                const res = await axios.get('vehicle/fetch/engines');
                engines.value = res.data;
            } catch (e) {
                console.error('Unable to fetch engines', e.response);
            }
        }

        async function fetchOffersByBudget(tab, params) {
            try {
                const res = await axios.get('fetch/offers', {params: params});
                budget[tab].data = res.data;
            } catch (e) {
                console.error('Unable to fetch offers by budget', e.response);
            }
        }

        async function fetchRecommendedOffers() {
            try {
                const res = await axios.get(
                    'fetch/offers', {params: {mostViewers: true, limit: 10, "category": category}}
                );
                recommended.data = res.data;
            } catch (e) {
                console.error('Unable to fetch recommended offers', e.response);
            }
        }

        async function fetchOffersByType(type) {
            let offers = {
                tabName: type.name,
                params: {"type": type.id, limit: 10},
                data: []
            };
            try {
                const res = await axios.get(
                    'fetch/offers', {params: offers.params}
                );
                offers.data = res.data;
                bodyType[type.id] = offers;
            } catch (e) {
                console.error('Unable to fetch offers by type', e.response);
            }
        }

        async function fetchTypes() {
            try {
                const res = await axios.get(
                    'vehicle/fetch/vehicle-type/' + category + '/category/1'
                );

                for (let i in res.data) {
                    //todo handle on click
                    fetchOffersByType(res.data[i]);
                }
            } catch (e) {
                console.error('Unable to fetch types', e.response);
            }
        }

        onMounted(() => {
            fetchPopularRegions(),
                fetchBrands(),
                fetchEngines(),
                fetchOffersByBudget("vehicles5000", {budgetMax: 4999, limit: 10, "category": category})
            fetchOffersByBudget("vehicles10000", {budgetMin: 5000, budgetMax: 10000, limit: 10, "category": category}),
                fetchRecommendedOffers(),
                fetchTypes()

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

