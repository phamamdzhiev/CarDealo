<template>
    <div class="vehicle-singleton">
        <div class="vehicle-image-wrapper">
            <router-link :to="{ name: 'single-listing', params: {uid: offer.uid}}">
                <img v-if="offer.image"
                     class="img-fluid"
                     :src="asset(offer.image)"
                     alt=""
                />
                <img v-else :src="asset('noimage.jpg')" class="img-fluid" alt="Default image">
            </router-link>
        </div>
        <add-favorites :offer="offer"/>

        <div class="vehicle-details">
            <router-link :to="{ name: 'single-listing', params: {uid: offer.uid}}">
                {{ offer.title }}
            </router-link>
            <div class="price">
                <span>{{ formatPrice }}</span>
            </div>
            <div class="dotlist text-normal-gray">
                <span>{{ offer.km }} км</span>
                <span>Бензин</span>
                <span>Пловдив</span>
            </div>
        </div>
    </div>
</template>

<script>
import assetMixin from '../../composables/asset';
import {ref} from "vue";
import AddFavorites from "./partials/AddFavorites";

export default {
    name: "CarSingleItem",
    mixins: [assetMixin],
    props: ['offer'],
    components: {
        AddFavorites
    },
    computed: {
        formatPrice() {
            return this.offer.price === 0 ? 'По договаряне' : this.offer.price + ' лв.'
        }
    }
}
</script>
