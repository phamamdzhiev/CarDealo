<template>
    <div class="form-floating">
        <select class="form-select form__input m-0"
                :id="id"
                @change="selectEmit($event)"
        >
            <option v-for="option in options"
                    :key="option.id"
                    :value="JSON.stringify(option)">
                {{ option.name }}
            </option>
        </select>
        <label :for="id">{{ label }}</label>
    </div>
</template>

<script>
export default {
    name: "SelectField",
    emits:['emitFromSelectable'],
    props: {
        id: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        options: {
            type: Array,
            required: true
        }
    },
    methods: {
        selectEmit(e) {
            this.$emit('emitFromSelectable', {key: e.target.id, value: JSON.parse(e.target.value)});
        }
    }
}
</script>

<style scoped>

</style>
