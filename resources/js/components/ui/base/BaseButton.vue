<template>
    <router-link :to="{ path: genLink }" class="base-button">
        <slot></slot>
    </router-link>
</template>
<script>
export default {
    props: {
        link: {
            type: String,
            default: "/",
        },
    },
    computed: {
        genLink() {
            return "/" + this.link;
        },
    },
};
</script>
