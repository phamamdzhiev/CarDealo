<template>
    <div class="currently__chosen my-3">
        <span v-if="getAllData['car_brand']">
            {{ getAllData['car_brand'] }}
        </span>

        <span v-if="getAllData['car_model']">
            {{ getAllData['car_model'] }}
        </span>

        <span v-if="getAllData['car_year']">
            {{ getAllData['car_year'] }}
        </span>

        <span v-if="getAllData['car_fuel']">
            {{ getAllData['car_fuel'] }}
        </span>

        <span v-if="getAllData['car_transmission']">
            {{ getAllData['car_transmission'] }}
        </span>

        <span v-if="getAllData['car_hp']">
            {{ getAllData['car_hp'] }} к.с.
        </span>

        <span v-if="getAllData['car_km']">
            {{ getAllData['car_km'] }} км.
        </span>
    </div>
</template>

<script>
export default {
    name: "TopBar",
    computed: {
        getAllData() {
            return this.$store.getters['sellCar/getAllData'];
        },
    }
}
</script>
