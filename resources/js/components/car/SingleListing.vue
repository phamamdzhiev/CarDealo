<template>
    <spinner v-if="loading"/>
    <div v-else-if="singleOffer && !loading">
        <Swiper :slides-per-view="3"
                :navigation="false"
        >
            <SwiperSlide v-for="item in singleOffer.images" :key="item">
                <img
                    class="img-fluid"
                    :src="asset(item.image)"
                    alt=""
                />
            </SwiperSlide>
        </Swiper>
        <div style="position: relative; max-width: 750px; margin: 2.5rem auto">
            <div class="gallery position-absolute">
                <i class="fa-solid fa-image fs-4"></i>
            </div>
            <div class="panel position-relative">

                <div class="offer-details px-4 pb-4 pt-5">

                    <div class="heading">
                        <h4 class="fw-bold">
                            <span>{{ singleOffer.title }}</span>
                        </h4>
                        <h5 class="fw-bold">{{ singleOffer.price }} лв.</h5>
                        <p>{{ singleOffer.description }}</p>

                        <button class="fw-bold base-button">Виж детайли на собственика</button>
                    </div>
                </div>
                <div class="share-section">
                    <ul class="d-flex justify-content-between p-3">
                        <li class="fs-6"><i class="bi bi-heart fs-6"></i>Добави в любими</li>
                        <li><i class="bi bi-share fs-6"></i>Сподели</li>
                        <li><i class="bi bi-flag fs-6"></i>Сигнализирай</li>
                        <li><i class="bi bi-plus-lg fs-6"></i>Сравни с друга обява</li>
                    </ul>
                </div>
            </div>
            <div class="panel">
                <div class="offer-details p-4">
                    <div class="heading">
                        <h5 class="fw-bold">
                            <span>Детайли на офертата</span>
                        </h5>
                        <div>
                            <ul>
                                <li>{{ singleOffer.vehicle.hp }} к.с</li>
                                <li>{{ singleOffer.vehicle.transmission.name ?? '' }}</li>
                                <li>{{ singleOffer.vehicle.year }}</li>
                                <li>{{ singleOffer.vehicle.km }} км.</li>
                                <li>{{ singleOffer.vehicle.fuel.name ?? '' }}</li>
                                <li>{{ singleOffer.user.is_business ? 'Търговец' : 'Частно лице' }},
                                    {{ singleOffer.city.name }} ({{ singleOffer.city.region.name }})
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="offer-details p-4">
                    <div class="heading">
                        <h5 class="fw-bold">
                            <span>Спецификации и екстри</span>
                        </h5>
                        <div>
                            <ul v-for="extra in singleOffer.vehicle.extras" :key="extra.id">
                                <li>
                                    <span class="pe-1">
                                        <i class="fa-solid fa-circle-check fs-6 text-success-color"></i>
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
        </div>
    </div>
</template>

<script>
import axios from "axios";
import {onMounted, ref, inject} from "vue";
import BaseCard from "../ui/base/BaseCard";
import router from "../../router";
import assetMixin from '../../composables/asset';
import {Swiper, SwiperSlide} from "swiper/vue";
import 'swiper/css';

export default {
    name: "SingleListing",
    components: {BaseCard, Swiper, SwiperSlide},
    mixins: [assetMixin],
    props: {
        id: String
    },
    setup(props) {
        let singleOffer = ref(null);
        let loading = ref(false);
        const $toast = inject('$toast');

        async function fetchSingleOffer() {
            try {
                loading.value = true;
                const res = await axios.get(`/fetch/offer/${props.id}`);
                loading.value = false;
                if (res.data.success) {
                    singleOffer.value = res.data.data;
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


        return {
            singleOffer,
            loading
        }
    }
}
</script>

<style scoped>
.share-section {
    border-top: 1px solid hsla(0, 0%, 59.2%, .2);
}

.panel {
    border-radius: 8px;
    background-color: white;
    box-shadow: 4px 4px 8px 0 rgb(36 39 44 / 6%);
    border: 1px solid #e9e9e9;
    overflow: hidden;
    margin-bottom: 1rem;

}

.base-button {
    box-shadow: 0 8px 8px 0 rgb(247 93 52 / 20%);
    max-width: 300px;
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
