<template>
    <div @click="addToFavorites">
        <i :class="['bi fs-6 pe-1', {'bi-heart-fill text-base-color':isFavorite, 'bi-heart': !isFavorite}]"></i>
        <span v-if="$route.name === 'single-listing'">
            {{ isFavorite ? 'Премахни от любими' : 'Добави в любими' }}
        </span>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {computed, onMounted, reactive, ref} from "vue";

export default {
    name: "AddFavorites",
    props: {
        offer: {
            type: Object,
            required: true
        }
    },
    setup(props) {
        const store = useStore();
        const isFavorite = ref(false);

        const obj = reactive({
            // id: props.offer.id,
            // fuel: props.offer.vehicle.fuel.name,
            // transmission: props.offer.vehicle.transmission.name,
            price: props.offer.price,
        });

        const localStorageOffers = computed(() => {
            return store.getters['favoriteStore/getFavorite'];
        });


        function containsObject(obj, list) {
            return list.some(elem => elem === JSON.stringify(obj));
        }

        function addToFavorites() {
            const index = localStorageOffers.value.findIndex(e => e === JSON.stringify(obj));

            if (isFavorite.value) {
                store.commit('favoriteStore/removeFavorite', index);
                isFavorite.value = false
            } else {
                store.commit('favoriteStore/setFavorite', JSON.stringify(obj));
                isFavorite.value = true;
            }
        }

        onMounted(() => {
            isFavorite.value = containsObject(obj, localStorageOffers.value)
        })

        return {
            addToFavorites,
            isFavorite
        }
    }

}
</script>
