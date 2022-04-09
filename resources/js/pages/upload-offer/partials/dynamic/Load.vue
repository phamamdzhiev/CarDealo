<template>
    <FormKit
        type="number"
        id="load"
        name="load"
        label="Товаримост"
        validation="required|number"
        help="в кг"
        v-model.lazy="load"
    />
</template>

<script>
export default {
    name: "Load",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        load: {
            get() {
                return this.getState.load;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'load', value});
            }
        }
    }
}
</script>
