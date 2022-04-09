<template>
    <FormKit
        type="number"
        id="length"
        name="length"
        label="Дължина"
        validation="number"
        v-model.lazy="length"
    />
</template>

<script>
export default {
    name: "Length",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        length: {
            get() {
                return this.getState.length;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'length', value});
            }
        }
    }
}
</script>
