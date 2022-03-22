<template>
    <div
        id="carouselExampleSlidesOnly"
        class="carousel slide"
        data-bs-ride="carousel"
    >
        <div class="carousel-inner">
            <div class="carousel-item active" :style="setBannerAndImageHeight">
                <div class="banner-heading mt-5">
                    <div class="container">
                        <h1 class="text-white fw-bold mb-5" style="max-width:600px;">
                           {{heading}}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        heading: {
            type: String
        },
        bannerImage: {
            type: String,
            required: true,
        },
        height: {
            type: String,
            required: false,
            default: "546",
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
