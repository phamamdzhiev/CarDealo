<template>
    <div class="home">
        <base-carousel :bannerImage="'https://stimg.cardekho.com/images/uploadimages/1640343008219/Home-Page-Banner---1686x540.jpg'">
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
</template>

<script>
import BaseCarousel from "../components/ui/base/BaseCarousel.vue";
export default {
    name: "Home",
    components: {
        BaseCarousel,
    },
    mounted() {
        console.log('Home mounted', window.AUTH)
    }
};
</script>
