<template>
    <Swiper :breakpoints="swiperBreakPoints"
            :slides-per-view="4"
            :space-between="40"
            :navigation="true"
            :modules="modules"
            virtual>
        <SwiperSlide v-for="slide in 9" :key="slide" :virtualIndex="slide">
            <CarSingleItem></CarSingleItem>
        </SwiperSlide>
    </Swiper>
</template>

<script>
import CarSingleItem from "../../../components/car/CarSingleItem";
import {Swiper, SwiperSlide} from "swiper/vue";
import {Navigation, Virtual} from "swiper";
import 'swiper/css';
import 'swiper/css/navigation';

export default {
    name: "UsedCarsCarousels",
    components: {
        Swiper, SwiperSlide, CarSingleItem
    },


    setup() {
        const swiperModules = [Navigation, Virtual];
        const swiperBreakPoints = {
            0: {
                slidesPerView: 1,
            },
            480: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 4,
            }
        }
        return {
            modules: swiperModules,
            swiperBreakPoints
        }

    }
}
</script>

<style>
.carousel__track {
    padding: 7px 0;
}

.carousel__slide {
    /*padding: 0 5px;*/
}

.carousel__prev--in-active,
.carousel__next--in-active {
    display: none;
}

.carousel__prev,
.carousel__next {
    background-color: #fd5750;
    border: 4px solid white;
}
</style>
