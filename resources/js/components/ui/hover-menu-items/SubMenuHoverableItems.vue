<template>
    <div class="sub__menu__items">
        <router-link v-for="item in subLink" :key="item.id" :to="item.link">
            {{ item.linkText }}
        </router-link>
    </div>
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
