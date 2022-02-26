<template>
    <div class="currently__chosen my-3">
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

        <span v-if="getState.hp">
            {{ getState.hp }} к.с
        </span>

        <span v-if="getState.km">
            {{ getState.km }} км.
        </span>
    </div>
</template>

<script>
export default {
    name: "TopBar",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        }
    }
}
</script>
