<template>
    <div class="d-inline-block" v-if="favOffers.length > 0" title="Любими обяви" @click="showFavoriteModal">
        <i class="bi bi-suit-heart-fill text-base-color ps-4 fs-4"></i>
        <sub class="fw-bold">{{ favOffers.length }}</sub>
        <template v-if="isShown">
            <teleport to="#app">
                <favorite-offers-modal
                    @remove-offer-from-favorite="removeFromFavorite"
                    @close-modal="showFavoriteModal"
                    :offers="favOffers"/>
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
            isShown.value = !isShown.value;
        }

        const localStorageOffers = computed(() => {
            return store.getters['favoriteStore/getFavorite'];
        });

        function removeFromFavorite(id) {
            // const index =
            //     JSON.parse(localStorageOffers.value).findIndex(e => e.id === id);
            // console.log(
            //     'Remove from list with id => ', id
            // )
            // store.commit('favoriteStore/removeFavorite', index);
        }

        return {
            favOffers,
            showFavoriteModal,
            isShown,
            removeFromFavorite
        }
    }
}
</script>

<style scoped>

</style>
