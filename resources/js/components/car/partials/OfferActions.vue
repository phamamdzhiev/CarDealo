<template>
    <div class="share-section">
        <ul class="d-flex justify-content-between px-1 pt-2 pb-0">
            <li>
                <i class="bi bi-eye fs-6 pe-1"></i>
                {{ offer.visits }}
            </li>
            <li>
                <add-favorites :offer="offer"/>

            </li>
            <li @click="shareOffer">
                <i class="bi bi-share fs-6 pe-1"></i>
                Сподели
            </li>
            <fraud :offer="offer"/>
            <!-- <li><i class="bi bi-plus-lg fs-6"></i>Сравни с друга обява</li>-->
        </ul>
    </div>
</template>

<script>
import Fraud from "./Fraud";
import AddFavorites from "./AddFavorites";

export default {
    name: "OfferActions",
    props: {
        offer: {
            type: Object,
            required: true
        }
    },
    components: {
        Fraud,
        AddFavorites
    },
    setup() {
        function shareOffer() {
        }

        return {
            shareOffer,
        }
    }
}
</script>

<style scoped>
.share-section ul li:not(:first-child) {
    cursor: pointer;
}
</style>
