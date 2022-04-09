<template>
    <FormKit
        type="number"
        id="hp"
        name="hp"
        label="Мощност"
        validation="required|number|max:2000|min:1"
        help="в конски сили"
        v-model.lazy="hp"
    />
</template>

<script>
export default {
    name: "Hp",
    computed: {
        getState() {
            return this.$store.getters['uploadOffer/getVehicleState'];
        },
        hp: {
            get() {
                return this.getState.hp;
            },
            set(value) {
                this.$store.commit('uploadOffer/setVehicleState', {key: 'hp', value});
            }
        }
    }
}
</script>
