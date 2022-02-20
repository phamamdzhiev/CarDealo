<template>
    <div
        id="carouselExampleSlidesOnly"
        class="carousel slide"
        data-bs-ride="carousel"
    >
        <div class="carousel-inner">
            {{setBannerAndImageHeight}}
            <div class="carousel-item active" :style="setBannerAndImageHeight">
                <slot></slot>
            </div>
            <slot name="simpleSearch"></slot>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        bannerImage: {
            type: String,
            required: true,
        },
        height: {
            type: Number,
            required: false,
            default: 546,
        },
    },
    computed: {
        setBannerAndImageHeight() {
            return `background-image: url(${this.bannerImage});height: ${this.height}px`;
        },
    },
};
</script>
<style scoped>
.carousel-item {
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
