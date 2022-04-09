<template>
    <FormKit
        type="number"
        id="workingHours"
        name="workingHours"
        label="Работни часове"
        validation="number"
        v-model.lazy="workingHours"
    />
</template>

<script>
export default {
    name: "WorkingHours",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        workingHours: {
            get() {
                return this.getState.workingHours;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'workingHours', value});
            }
        }
    }
}
</script>

<style scoped>

</style>
