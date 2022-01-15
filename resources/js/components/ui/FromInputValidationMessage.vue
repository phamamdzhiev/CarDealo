<template>
    <small class='input__error'>
        <i class="bi bi-exclamation-circle"></i>
        {{ message }}
    </small>
</template>

<script>
export default {
    name: "FromInputValidationMessage",
    props: {
        message: {
            type: String,
            required: true,
            default: 'Моля въведете това поле'
        }
    }
}
</script>
