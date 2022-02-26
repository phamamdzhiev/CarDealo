<template>
    <h5 class="fw-bold">{{title}}</h5>
</template>

<script>
export default {
    name: "Heading",
    props: {
        title: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
