<template>
    <div>
        <slot></slot>
        <div id="brand">
            <div v-for="brand in carBrands" :key="brand.id"
                 class="item"
                 :class="{ active: brand.name === getAllData['car_brand'] }"
                 @click="selectBrand(brand.name, brand.id)">
                {{ brand.name }}
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "DisplayCarBrands",
    props: ['carBrands'],
    emits: ['setCarBrandEmit'],
    computed: {
        ...mapGetters('sellCar', ['getAllData']),
    },
    methods: {
        selectBrand(brandName, brandID) {
            this.$emit('setCarBrandEmit', {brandName, brandID});
        }
    }
}
</script>
