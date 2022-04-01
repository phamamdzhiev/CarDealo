<template>
    <div class="d-inline-block" v-if="favOffers.length > 0" title="Любими обяви" @click="showFavoriteModal">
        <i class="bi bi-suit-heart-fill text-base-color ps-4 fs-4"></i>
        <sub class="fw-bold">{{ favOffers.length }}</sub>
        <template v-if="isShown">
            <teleport to="#app">
                <favorite-offers-modal :offers="favOffers"/>
            </teleport>
        </template>
    </div>
</template>

<script>
import {computed, ref} from "vue";
import {useStore} from "vuex";
import FavoriteOffersModal from "../../../car/partials/FavoriteOffersModal";

export default {
    name: "ShowFavoriteOffers",
    components: {
        FavoriteOffersModal
    },
    setup() {
        const store = useStore();
        const isShown = ref(false);
        const favOffers = computed(() => {
            return store.getters['favoriteStore/getFavorite']
        });

        function showFavoriteModal() {
            console.log(
                isShown.value
            )
            isShown.value = !isShown.value;
        }

        return {
            favOffers,
            showFavoriteModal,
            isShown
        }
    }
}
</script>

<style scoped>

</style>
