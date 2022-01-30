<template>
    <div>
        <base-carousel :height="400"
                       :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/used-car-hero-img.jpg'"></base-carousel>
        <BaseCard>
            <h5 class="fw-bold">Употребявани автомобили</h5>
            <p>
                Намерете пълен списък на сертифицирани употребявани автомобили в
                България. Можете да изберете коли втора употреба, като приложите
                филтри като местоположение, цена, тип каросерия, марка и т.н.
            </p>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Препоръчани автомобили за теб</h5>
            <Carousel :settings="sliderConfig">
                <Slide v-for="slide in 10" :key="slide">
                    <div class="carousel__item">
                        <CarSingleItem></CarSingleItem>
                    </div>
                </Slide>
                <template #addons>
                    <Navigation/>
                </template>
            </Carousel>
        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили в България по град</h5>

        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили според бюджет</h5>

        </BaseCard>

        <BaseCard>
            <h5 class="fw-bold">Автомобили по каросерия</h5>

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
import {Carousel, Slide, Navigation} from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import BaseCarousel from "../../components/ui/base/BaseCarousel.vue";
import BaseCard from "../../components/ui/base/BaseCard.vue";
import CarSingleItem from "../../components/car/CarSingleItem";
import {onMounted, reactive, ref} from "vue";

export default {
    components: {
        BaseCarousel,
        BaseCard,
        CarSingleItem,
        Carousel,
        Slide,
        Navigation
    },
    setup() {
        const sliderConfig = {
            itemsToShow: 4,
            snapAlign: 'start',
        }

        const data = reactive({
            name: 0
        });

        const a = ref([
            {name: 'Petar', age: 24},
            {name: 'Raddy', age: 21},
        ])

        onMounted(() => {
            console.log('mounted');
        });

        return {
            data,
            sliderConfig
        }
    }
};
</script>
