<template>
    <transition name="fade">
        <div class="sub__menu__items">
            <ul>
                <li class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :to="{name: 'advanced.filters'}">
                        <i class="fa-solid pe-2 fa-magnifying-glass"></i>
                        Подробно търсене
                    </router-link>
                </li>
                <li class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :to="{name: 'offers.showcase', query: {type: 1}}">
                        <i class="fa-solid pe-2 fa-car"></i>
                        {{ window.APP_NAME }} автомобили
                    </router-link>
                </li>

                <li class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :to="{name: 'offers.showcase', query: {type: 2}}">
                        <i class="fa-solid pe-2 fa-bus-simple"></i>
                        {{ window.APP_NAME }} бусове
                    </router-link>
                </li>

                <li class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :to="{name: 'offers.showcase', query: {type: 3}}">
                        <i class="fa-solid pe-2 fa-truck"></i>
                        {{ window.APP_NAME }} камиони
                    </router-link>
                </li>

                <li class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :to="{name: 'offers.showcase', query: {type: 4}}">
                        <i class="fa-solid pe-2 fa-motorcycle"></i>
                        {{ window.APP_NAME }} мотори
                    </router-link>
                </li>

                <li class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :to="{name: 'offers.showcase', query: {type: 5}}">
                        <i class="fa-solid pe-2 fa-sailboat"></i>
                        {{ window.APP_NAME }} лодки
                    </router-link>
                </li>

                <li class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :to="{name: 'offers.showcase'}">
                        <i class="fa-solid pe-2 fa-border-all"></i>
                        Всички обяви
                    </router-link>
                </li>

                <li class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :to="{name: 'my.listing'}">
                        <i class="fa-solid pe-2 fa-bars-staggered"></i>
                        Моите обяви
                    </router-link>
                </li>
            </ul>
        </div>
    </transition>
</template>

<script>
import assetMixin from "../../../composables/asset";

export default {
    inject: ['window'],
    mixins: [assetMixin]
};
</script>
<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity .2s ease-in-out;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
