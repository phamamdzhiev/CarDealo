<template>
    <FormKit
        type="select"
        :options="options"
        id="engineType"
        name="engineType"
        label="Вид на двигателя"
        placeholder="Вид на двигателя"
        validation="required"
        v-model.lazy="engineType"
    />
</template>

<script>
export default {
    name: "EngineType",
    data() {
        return {
            options: [
                {value: 1, label: 'Няма'},
                {value: 2, label: 'Двутактов'},
                {value: 3, label: 'Четиритактов'}
            ]
        }

    },
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        engineType: {
            get() {
                return this.getState.engineType;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'engineType', value});
            }
        }
    }
}
</script>
