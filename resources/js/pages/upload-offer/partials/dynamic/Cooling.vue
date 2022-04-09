<template>
    <FormKit
        type="select"
        :options="options"
        id="cooling"
        name="cooling"
        label="Охлаждане"
        placeholder="Охлаждане"
        v-model.lazy="cooling"
    />
</template>

<script>
export default {
    name: "Cooling",
    data() {
        return {
            options: [
                {value: 1, label: 'Водно'},
                {value: 2, label: 'Въздушно'},
            ]
        }

    },
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        cooling: {
            get() {
                return this.getState.cooling;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'cooling', value});
            }
        }
    }
}
</script>
