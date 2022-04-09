<template>
    <FormKit
        type="select"
        id="material"
        :options="options"
        name="material"
        label="Материал"
        placeholder="Материал"
        v-model.lazy="material"
    />
</template>

<script>
export default {
    name: "Material",
    data() {
        return {
            options: [
                {value: 1, label: 'Алуминий'},
                {value: 2, label: 'Желязо'},
                {value: 3, label: 'Дърво'},
                {value: 4, label: 'Кевлар'},
                {value: 5, label: 'PVC'},
                {value: 6, label: 'Друго'},
            ]
        }

    },
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        material: {
            get() {
                return this.getState.material;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'material', value});
            }
        }
    }
}
</script>
