<template>
    <FormKit
        type="number"
        id="km"
        name="km"
        label="Пробег"
        help="в километри"
        validation="required|number|max:999999|min:1"
        v-model.lazy="km"
    />
</template>

<script>
export default {
    name: "Km",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        km: {
            get() {
                return this.getState.km;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'km', value});
            }
        }
    }
}
</script>
