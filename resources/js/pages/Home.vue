<template>
    <div class="home">
        <base-carousel
            :bannerImage="'https://stimg.cardekho.com/pwa/img/bgimg/compare-cars.jpg'"
            height="450"
        >
            <div class="container-xxl">
                <div class="form__wrapper">
                    <h3 class="text-capitalize mb-4">Намери твоят автомобил</h3>
                    <ul id="used__or__not">
                        <li class="active">Нови</li>
                        <li>Употребявани</li>
                    </ul>
                    <ul id="by__brand__by_budget">
                        <li class="active">По Бюджет</li>
                        <li>По Модел</li>
                    </ul>
                    <form>
                        <select>
                            <option selected>Избери марка</option>
                            <option value="audi">Audi</option>
                            <option value="mercdes">Mercedes-Benz</option>
                        </select>
                        <select>
                            <option selected>Каросерия</option>
                            <option value="audi">SUV</option>
                            <option value="mercdes">Седан</option>
                        </select>
                        <button type="submit" class="base-button">TЪРСИ</button>
                    </form>
                </div>
            </div>
        </base-carousel>
    </div>

    <div class="base-card custom-container-lg py-4" style="margin-top: -2.275rem; position: relative;z-index: 5000">
        <h4 class="fw-bold mb-4"><i class="fa-solid fa-magnifying-glass pe-2"></i>Търсене на талига</h4>
        <div class="d-grid" id="simple_search">
            <FormKit
                type="select"
                id="mock"
                label="Тип на превозното средство"
                name="small_country"
                :options="['Авомобил', 'Лодка', 'Мотор']"
            />
            <FormKit
                disabled
                type="select"
                id="mock"
                label="Марка на превозното средство"
                name="small_country"
                :options="['Модел']"
            />
            <FormKit
                disabled
                type="select"
                id="mock"
                label="Модел на превозното средство"
                name="small_country"
                :options="['Модел']"
            />
        </div>
    </div>


    <!--    <FeaturedCarouselVehicles heading="Препоръчани автомобили" :props-data="recommended"/>-->
</template>

<script>
import BaseCarousel from "../components/ui/base/BaseCarousel.vue";
import FeaturedCarouselVehicles from "../components/used/partials/FeaturedCarouselVehicles";
import {reactive} from "vue";
import BaseCard from "../components/ui/base/BaseCard";

export default {
    name: "Home",
    components: {
        BaseCard,
        BaseCarousel,
        FeaturedCarouselVehicles
    },
    setup() {
        const recommended = reactive({
            data: [
                {name: 'Benz'},
                {name: 'Dizel'},
                {name: 'GAs'},
                {name: 'Hibris'}
            ]
        });

        return {
            recommended
        }
    }
};
</script>
<style scoped>

#simple_search {
    grid-template-columns: repeat(3, 1fr);
    gap: 15px
}
</style>
