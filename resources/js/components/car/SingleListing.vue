<template>
    <spinner v-if="loading"/>
    <div v-else-if="singleOffer && !loading">
        <div style="overflow: hidden">
            <Swiper :slides-per-view="3"
                    :navigation="true"
                    :modules="modules"
            >
                <SwiperSlide v-for="item in singleOffer.images" :key="item">
                    <img
                        class="img-fluid"
                        :src="asset(item.image)"
                        alt=""
                    />
                </SwiperSlide>
            </Swiper>
        </div>
        <div style="position: relative; max-width: 750px; margin: 2.5rem auto">
            <div class="gallery position-absolute">
                <i class="fa-solid fa-image fs-4"></i>
            </div>
            <div class="base-card position-relative">

                <div class="offer-details px-4 pb-4 pt-5">

                    <div class="heading">
                        <h4 class="fw-bold">
                            <span>{{ singleOffer.title }}</span>
                        </h4>
                        <h5 class="fw-bold text-base-color">{{ singleOffer.price }} лв.</h5>
                        <p>{{ singleOffer.description }}</p>

                        <button class="fw-bold base-button">Виж детайли на собственика</button>
                    </div>
                </div>
                <OfferActions :visits="singleOffer.visits"></OfferActions>
            </div>
            <div class="base-card">
                <div class="offer-details p-3">
                    <div class="heading">
                        <h5 class="fw-bold">
                            <span>Детайли на офертата</span>
                        </h5>
                        <div class="vehicle-overview">
                            <ul>
                                <li>
                                    <span class="head">Мощност</span>
                                    <span>
                                        <i class="fa-solid fa-horse fs-6 pe-1"></i>
                                        {{ singleOffer.vehicle.hp }} к.с
                                    </span>
                                </li>
                                <li>
                                    <span class="head">Трансмисия</span>
                                    <span>
                                        <i class="fa-solid fa-gears fs-6 pe-1"></i>
                                        {{ singleOffer.vehicle.transmission.name ?? '' }}
                                    </span>
                                </li>
                                <li>
                                    <span class="head">Година на производство</span>
                                    <span>
                                        <i class="fa-solid fa-calendar-days fs-6 pe-1"></i>
                                        {{ singleOffer.vehicle.year }}
                                    </span>
                                </li>
                                <li>
                                    <span class="head">Пробег</span>
                                    <span>
                                        <i class="fa-solid fa-road fs-6 pe-1"></i>
                                        {{ singleOffer.vehicle.km }} км.
                                    </span>
                                </li>
                                <li>
                                    <span class="head">Двигател</span>
                                    <span>
                                        <i class="fa-solid fa-gas-pump fs-6 pe-1"></i>
                                        {{ singleOffer.vehicle.fuel.name ?? '' }}
                                    </span>
                                </li>
                                <li>
                                    <span class="head">Качена от</span>
                                    <span>
                                        <i class="fa-solid fa-user fs-6 pe-1"></i>
                                        {{ singleOffer.user.is_business ? 'Търговец' : 'Частно лице' }}
                                    </span>
                                </li>
                                <li>
                                    <span class="head">Регион</span>
                                    <span><i class="fa-solid fa-location-dot fs-6 pe-1"></i>
                                        {{ singleOffer.city.name }}
                                        ({{ singleOffer.city.region.name }})</span>
                                </li>
                                <li>
                                    <span class="head">Състояние</span>
                                    <span><i class="fa-solid fa-star fs-6 pe-1"></i>
                                        {{ vehicleCondition }}
                                    </span>
                                </li>
                                <li>
                                    <span class="head">Добавена</span>
                                    <span><i class="fa-solid fa-clock fs-6 pe-1"></i>
                                        {{ singleOffer.created_at }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="base-card">
                <div class="offer-details p-3">
                    <div class="heading">
                        <h5 class="fw-bold">
                            <span>
                                <i class="fa-solid fa-sparkles fs-5"></i>
                            </span>
                            <span>Спецификации и екстри</span>
                        </h5>
                        <div class="specs">
                            <ul>
                                <li v-for="extra in singleOffer.vehicle.extras" :key="extra.id">
                                    <span class="pe-1">
                                        <i class="fa-solid fa-check fs-6 text-success-color"></i>
                                    </span>
                                    <span>
                                        {{ extra.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <VehicleAndValuationAd
                heading="Можеш и ти лесно да продадеш своя автомобил"
                sub-heading="Директно от вкъщи"
                image="https://ik.imagekit.io/gaicl5qj9hl/tr:w-130,h-130/icons/sell-car_vNZwdICyt.png?ik-sdk-version=javascript-1.4.3&updatedAt=1643796442201"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import {onMounted, ref, inject, computed} from "vue";
import BaseCard from "../ui/base/BaseCard";
import router from "../../router";
import assetMixin from '../../composables/asset';
import {Swiper, SwiperSlide} from "swiper/vue";
import 'swiper/css';
import OfferActions from "./partials/OfferActions";
import VehicleAndValuationAd from "../used/partials/VehicleAndValuationAd";
import {Navigation, Virtual} from "swiper";

export default {
    name: "SingleListing",
    components: {BaseCard, Swiper, SwiperSlide, OfferActions, VehicleAndValuationAd},
    mixins: [assetMixin],
    props: {
        uid: String
    },
    inject: ['window'],
    setup(props) {
        let singleOffer = ref(null);
        let loading = ref(false);
        const $toast = inject('$toast');

        const vehicleCondition = computed(() => {
            switch (singleOffer.value.condition) {
                case 'NEW':
                    return 'Нов'
                case 'OLD':
                    return 'Употребяван'
                case 'PARTS':
                    return 'На части'
            }
        })

        async function fetchSingleOffer() {
            try {
                loading.value = true;
                const res = await axios.get(`/fetch/offer/${props.uid}`);
                loading.value = false;
                if (res.data.success) {
                    singleOffer.value = res.data.data;
                    console.log(singleOffer.value)
                }
            } catch (e) {
                loading.value = false;
                if (e.response.data) {
                    $toast.open({
                        message: "Има проблем с тази обява, моля опитайте по-късно",
                        type: 'error',
                        dismissible: true,
                        duration: 5000,
                        //onDismiss: () => { router.replace({name: 'Home'}) }
                    });
                }
            }
        }

        onMounted(() => {
            fetchSingleOffer()
        });
        const swiperModules = [Navigation, Virtual];

        return {
            modules: swiperModules,
            singleOffer,
            loading,
            vehicleCondition
        }
    }
}
</script>

<style scoped>
/*swiper*/
.swiper-button-prev {
    left: 1rem !important;
}

.swiper-button-next {
    right: 1rem !important;
}

.share-section {
    border-top: 1px solid hsla(0, 0%, 59.2%, .2);
}

.base-button {
    box-shadow: 0 8px 8px 0 rgb(247 93 52 / 20%);
    max-width: 300px;
}

.base-card {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.gallery {
    top: -25px;
    left: 1rem;
    background-color: white;
    height: 50px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    border-radius: 50%;
    box-shadow: 0 8px 8px 0 #c5c5c5;
    transform: translate(50%, 0);
    z-index: 50;
}
</style>
