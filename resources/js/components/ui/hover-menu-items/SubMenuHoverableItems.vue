<template>
    <transition name="fade">
        <div class="sub__menu__items">
            <router-link v-for="item in subLink" :key="item.id" :to="item.link">
                {{ item.linkText }}
            </router-link>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        subLink: {
            type: Array,
            required: true,
        },
    },
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
