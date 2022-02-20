<template>
    <div class="position-absolute password-eye translate-middle-y">
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
.password-eye {
    right: 1rem;
    top: calc((3.5rem + 2px) / 2);
}
</style>
