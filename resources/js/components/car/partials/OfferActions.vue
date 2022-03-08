<template>
    <div class="share-section">
        <ul class="d-flex justify-content-between px-1 pt-2 pb-0">
            <li>
                <i class="bi bi-eye fs-6 pe-1"></i>
                {{ visits }}
            </li>
            <li @click="addToFavorites">
                <i class="bi bi-heart fs-6 pe-1"></i>
                Добави в любими
            </li>
            <li @click="shareOffer">
                <i class="bi bi-share fs-6 pe-1"></i>
                Сподели
            </li>
            <li @click="reportOffer">
                <i class="bi bi-flag fs-6 pe-1"></i>
                Сигнализирай
            </li>
            <!-- <li><i class="bi bi-plus-lg fs-6"></i>Сравни с друга обява</li>-->
        </ul>
    </div>
</template>

<script>
export default {
    name: "OfferActions",
    props: ['visits'],
    setup() {
        function addToFavorites() {
        }

        function shareOffer() {
        }

        function reportOffer() {
        }

        return {
            addToFavorites,
            shareOffer,
            reportOffer
        }
    }
}
</script>

<style scoped>
.share-section ul li:not(:first-child) {
    cursor: pointer;
}
</style>
