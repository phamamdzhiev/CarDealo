<template>
    <div class="form-floating form-group">
        <input :type="type" :id="id"
               class="form-control form__input"
               :placeholder="label"
               @change="vModelEmit($event)"
               :value="$store.getters['uploadOffer/getVehicleState'][id]"
        />
        <label :for="id">{{label}}</label>
<!--        <FromInputValidationMessage v-if="v$.carHp.$error"-->
<!--                                    :messages="v$.carHp.$errors"-->
<!--        />-->
    </div>
</template>

<script>
export default {
    name: "FormField",
    emits: ['updateField'],
    props: {
        type: {
            type: String,
            required: true
        },
        id: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        }
    },
    methods: {
        vModelEmit(e) {
            this.$emit('updateField', {key: e.target.id, value: e.target.value});
        }
    }
}
</script>
