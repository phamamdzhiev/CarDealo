<template>
    <FormKit
        type="number"
        id="wade"
        name="wade"
        label="Газене"
        validation="number"
        v-model.lazy="wade"
    />
</template>

<script>
export default {
    name: "Wade",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        wade: {
            get() {
                return this.getState.wade;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'wade', value});
            }
        }
    }
}
</script>

<style scoped>

</style>
