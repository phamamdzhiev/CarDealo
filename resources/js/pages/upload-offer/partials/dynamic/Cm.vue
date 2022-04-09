<template>
    <FormKit
        type="number"
        id="cm3"
        name="cm3"
        label="Кубатура"
        help="куб. см"
        validation="required|number|max:9999|min:1"
        v-model.lazy="cm3"
    />
</template>

<script>
export default {
    name: "Cm",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        cm3: {
            get() {
                return this.getState.cm3;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'cm3', value});
            }
        }
    }
}
</script>
