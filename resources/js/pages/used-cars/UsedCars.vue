<template>
    <div>
        <base-carousel :height="400" :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/used-car-hero-img.jpg'"></base-carousel>
        <BaseCard>
            <h3 class="fw-bold">Употребявани автомобили</h3>
            <p>
                Намерете пълен списък на сертифицирани употребявани автомобили в
                България. Можете да изберете коли втора употреба, като приложите
                филтри като местоположение, цена, тип каросерия, марка и т.н.
            </p>
        </BaseCard>
        <BaseCard>
            <h3 class="fw-bold">Последно добавени</h3>
            <div class="showcase">
                <VueAgile :dots="false" :slidesToShow="4">
                    <div class="item slide">
                        <img
                            src="https://images10.gaadicdn.com/usedcar_image/320x240/zz1_crop_img_619b3049bc8a5_1637560393.jpg"
                            alt=""
                            class="img-responsive"
                        />
                        <div class="info">
                            <div class="top__info">
                                <span class="year">2005</span>
                                <span class="car">Skoda Octavia Mk2</span>
                                <span class="price">4 599 BGN</span>
                            </div>
                            <div class="bottom__info">
                                <small class="milliage">250 000</small>
                                <small class="fuel">Дизел</small>
                                <small class="city">Пловдив</small>
                            </div>
                        </div>
                    </div>
                    <div class="item slide">
                        <img
                            src="https://images10.gaadicdn.com/usedcar_image/320x240/zz1_crop_img_61cd6b18143f2_1640852248.jpg"
                            alt=""
                        />
                        <div>
                            <span class="year">2014</span>
                            <span class="car">BMW 535i F10</span>
                            <span class="price">17 800 BGN</span>
                        </div>
                        <div class="bottom-info">
                            <small class="milliage">128 000</small>
                            <small class="fuel">Бензин</small>
                            <small class="city">Велинград</small>
                        </div>
                    </div>
                    <div class="item slide">
                        <img
                            src="https://images10.gaadicdn.com/usedcar_image/320x240/zz1_crop_img_619b3049bc8a5_1637560393.jpg"
                            alt=""
                        />
                        <div>
                            <span class="year">2005</span>
                            <span class="car">Skoda Octavia Mk2</span>
                            <span class="price">4 599 BGN</span>
                        </div>
                        <div class="bottom-info">
                            <small class="milliage">250 000</small>
                            <small class="fuel">Дизел</small>
                            <small class="city">Пловдив</small>
                        </div>
                    </div>
                    <div class="item slide">
                        <img
                            src="https://images10.gaadicdn.com/usedcar_image/320x240/zz1_crop_img_61cd6b18143f2_1640852248.jpg"
                            alt=""
                        />
                        <div>
                            <span class="year">2014</span>
                            <span class="car">BMW 535i F10</span>
                            <span class="price">17 800 BGN</span>
                        </div>
                        <div class="bottom-info">
                            <small class="milliage">128 000</small>
                            <small class="fuel">Бензин</small>
                            <small class="city">Велинград</small>
                        </div>
                    </div>
                    <div class="item slide">
                        <img
                            src="https://images10.gaadicdn.com/usedcar_image/320x240/zz1_crop_img_619b3049bc8a5_1637560393.jpg"
                            alt=""
                        />
                        <div>
                            <span class="year">2005</span>
                            <span class="car">Skoda Octavia Mk2</span>
                            <span class="price">4 599 BGN</span>
                        </div>
                        <div class="bottom-info">
                            <small class="milliage">250 000</small>
                            <small class="fuel">Дизел</small>
                            <small class="city">Пловдив</small>
                        </div>
                    </div>
                    <div class="item slide">
                        <img
                            src="https://images10.gaadicdn.com/usedcar_image/320x240/zz1_crop_img_61cd6b18143f2_1640852248.jpg"
                            alt=""
                        />
                        <div>
                            <span class="year">2014</span>
                            <span class="car">BMW 535i F10</span>
                            <span class="price">17 800 BGN</span>
                        </div>
                        <div class="bottom-info">
                            <small class="milliage">128 000</small>
                            <small class="fuel">Бензин</small>
                            <small class="city">Велинград</small>
                        </div>
                    </div>
                </VueAgile>
            </div>
        </BaseCard>
    </div>
</template>
<script>
import BaseCarousel from "../../components/ui/base/BaseCarousel.vue";
import { VueAgile } from "vue-agile";
import BaseCard from "../../components/ui/base/BaseCard.vue";

export default {
    components: {
        BaseCarousel,
        VueAgile,
        BaseCard,
    },
};
</script>

<style>

</style>
