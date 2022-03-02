<template>
    <transition name="fade">
        <div class="sub__menu__items">
            <ul>
                <li v-for="item in subLink" class="d-flex align-items-center flex-nowrap px-2">
                    <router-link :key="item.id" :to="item.link">
                        <i v-if="item.icon" :class="`fa-solid pe-2 ${item.icon}`"></i>
                        {{ item.linkText }}
                    </router-link>
                </li>
            </ul>
        </div>
    </transition>
</template>

<script>
import assetMixin from "../../../composables/asset";
export default {
    props: {
        subLink: {
            type: Array,
            required: true,
        },
    },
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
