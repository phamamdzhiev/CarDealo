<template>
    <div class="vehicle-singleton">
        <div class="vehicle-image-wrapper">
            <router-link :to="'/car/' + offer.id">
                <img v-if="offer.images.length > 0"
                     class="img-fluid"
                     :src="asset('storage/' + offer.images[0].image)"
                     alt=""
                />
                <img v-else :src="asset('storage/noimage.jpg')" class="img-fluid" alt="Default image">
            </router-link>
        </div>
        <div class="vehicle-details">
            <router-link :to="'/car/' + offer.id">
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
import assetMixin from '../../mixins/asset';
import {ref} from "vue";

export default {
    name: "CarSingleItem",
    mixins: [assetMixin],
    props: ['offer'],
    computed: {
        formatPrice() {
            return this.offer.price === 0 ? 'По договаряне' : this.offer.price + ' лв.'
        }
    }
}
</script>
