<template>
    <ul v-if="errors">
        <li v-for="error in errors" :key="error">
            <span v-for="e in error" :key="e" class="text-danger-color">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ e }}
            </span>
        </li>
    </ul>
</template>

<script>
export default {
    name: "ErrorDisplay",
    props: {
        errors: {
            required: true,
        }
    }
}
</script>
