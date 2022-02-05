<template>
    <div class="vehicle-singleton">
        <div class="vehicle-image-wrapper">
            <router-link :to="'/car/' + offer.id">
                <img v-if="offer.images[0]"
                     class="img-fluid"
                     :src="asset('storage/' + offer.images[0].image)"
                     alt=""
                />
                <img v-else :src="asset('storage/noimage.jpg')" class="img-fluid" alt="Defaut image">
            </router-link>
        </div>
        <div class="vehicle-details">
            <router-link :to="'/car/' + offer.id">
                {{ offer.title }}
            </router-link>
            <div class="price">
                {{ offer.price }} <span>лв.</span>
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

export default {
    name: "CarSingleItem",
    mixins: [assetMixin],
    props: ['offer']
}
</script>
