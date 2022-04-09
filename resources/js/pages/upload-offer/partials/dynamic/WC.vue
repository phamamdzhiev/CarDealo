<template>
    <FormKit
        type="select"
        :options="options"
        id="wc"
        name="wc"
        label="Тоалетна"
        placeholder="Тоалетна"
        v-model.lazy="wc"
    />
</template>

<script>
export default {
    name: "WC",
    data() {
        return {
            options: [
                {value: 1, label: 'Химическа'},
                {value: 2, label: 'Стандартна'},
                {value: 3, label: 'Няма'},
            ]
        }

    },
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        wc: {
            get() {
                return this.getState.wc;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'wc', value});
            }
        }
    }
}
</script>
