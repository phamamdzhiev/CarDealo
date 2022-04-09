<template>
    <FormKit
        type="select"
        id="heating"
        :options="options"
        name="heating"
        label="Отопление"
        placeholder="Отопление"
        v-model.lazy="heating"
    />
</template>

<script>
export default {
    name: "Heating",
    data() {
        return {
            options: [
                {value: 1, label: 'Електрическо'},
                {value: 2, label: 'Газово'},
                {value: 3, label: 'Няма'}
            ]
        }

    },
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        heating: {
            get() {
                return this.getState.heating;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'heating', value});
            }
        }
    }
}
</script>

<style scoped>

</style>
