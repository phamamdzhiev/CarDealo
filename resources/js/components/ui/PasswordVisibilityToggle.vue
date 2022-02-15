<template>
    <div class="position-absolute top-50 translate-middle-y">
        <i :class="['bi fs-4', { 'bi-eye': fieldType === 'password', 'bi-eye-slash': fieldType === 'text'}]"></i>
    </div>
</template>

<script>
export default {
    name: "PasswordVisibilityToggle",
    props: {
        fieldType: {
            type: String,
            required: true,
            default: 'password'
        }
    }
}
</script>

<style scoped>
div {
    right: 1rem;
}
</style>
