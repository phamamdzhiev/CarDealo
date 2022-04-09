<template>
    <FormKit
        type="number"
        id="axis"
        name="axis"
        label="Брой оси"
        validation="required|number"
        v-model.lazy="axis"
    />
</template>

<script>
export default {
    name: "Axis",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        axis: {
            get() {
                return this.getState.axis;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'axis', value});
            }
        }
    }
}
</script>

<style scoped>

</style>
