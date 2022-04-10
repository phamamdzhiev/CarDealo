<template>
    <FormKit
        type="number"
        id="seats"
        name="seats"
        label="Брой места"
        validation="number"
        v-model.lazy="seats"
    />
</template>

<script>
export default {
    name: "SeatsNumber",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        seats: {
            get() {
                return this.getState.seats;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'seats', value});
            }
        }
    }
}
</script>
