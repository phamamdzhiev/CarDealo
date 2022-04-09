<template>
    <FormKit
        type="number"
        id="width"
        name="width"
        label="Дължина"
        validation="number"
        v-model.lazy="width"
    />
</template>

<script>
export default {
    name: "Width",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        width: {
            get() {
                return this.getState.width;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'width', value});
            }
        }
    }
}
</script>

<style scoped>

</style>
