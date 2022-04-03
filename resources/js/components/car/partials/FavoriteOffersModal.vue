<template>
    <div id="favorite-offers-modal" class="position-absolute min-vh-100">
        <div @click="closeModal" class="d-block text-center fs-4 fw-bold mt-4">
            X
        </div>
        <div v-for="offer in offers" class="d-flex p-3 mb-4 align-items-center shadow">
            <div>{{JSON.parse(offer)}}</div>
<!--            <div>-->
<!--                <ul>-->
<!--                    <li>{{ JSON.parse(offer).price }}</li>-->
<!--                    <li>{{ JSON.parse(offer).fuel }}</li>-->
<!--                    <li>{{ JSON.parse(offer).transmission }}</li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <div @click="removeFromFavorite(JSON.parse(offer).id)" class="d-block text-center fs-4 fw-bold mt-4">-->
<!--                X-->
<!--            </div>-->
        </div>
    </div>
</template>

<script>
export default {
    name: "FavoriteOffersModal",
    props: {
        offers: {
            type: Object,
            require: true
        }
    },
    setup(_, {emit}) {

        function closeModal() {
            emit('close-modal');
        }

        function removeFromFavorite(id) {
            emit('remove-offer-from-favorite',id);
        }

        return {
            closeModal,
            removeFromFavorite
        }
    }
}
</script>

<style scoped>
#favorite-offers-modal {
    width: 350px;
    background-color: white;
    box-shadow: 0 4px 8px 0 rgb(36 39 44 / 10%), 0 2px 2px 0 rgb(36 39 44 / 10%);
    top: 0;
    left: 0;
    z-index: 7000;
}
</style>
