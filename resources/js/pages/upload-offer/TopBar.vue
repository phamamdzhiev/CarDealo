<template>
    <div class="currently__chosen my-3">
        <span v-if="getState.vehicleType">
            {{ lookUpVehicleType }}
        </span>

        <span v-if="getState.brand">
            {{ getState.brand.name }}
        </span>

        <span v-if="getState.model">
            {{ getState.model.name }}
        </span>

        <span v-if="getState.year">
            {{ getState.year }}
        </span>


        <span v-if="getState.engine">
            {{ getState.engine.name }}
        </span>

        <span v-if="getState.transmission">
            {{ getState.transmission.name }}
        </span>

        <!--        <span v-if="$store.getters['carOffer/getState']">-->
        <!--            {{ getState.transmission.name }}-->
        <!--        </span>-->

        <!--        <span v-if="getAllData['car_hp']">-->
        <!--            {{ getAllData['car_hp'] }} к.с.-->
        <!--        </span>-->

        <!--        <span v-if="getAllData['car_km']">-->
        <!--            {{ getAllData['car_km'] }} км.-->
        <!--        </span>-->
    </div>
</template>

<script>
export default {
    name: "TopBar",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        lookUpVehicleType() {
            switch (this.getState.vehicleType) {
                case 1:
                    return 'Aвтомобил';
                case 2:
                    return 'Бус';
            }
        }
    }
}
</script>
