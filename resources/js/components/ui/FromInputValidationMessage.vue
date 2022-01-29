<template>
    <div v-for="message in messages" :key="message">
        <small class='input__error' >
            <i class="bi bi-exclamation-circle"></i>
            {{ message.$message }}
        </small>
    </div>
</template>

<script>
export default {
    name: "FromInputValidationMessage",
    props: {
        messages: {
            required: true,
        }
    }
}
</script>
