<template>
   <div class="container-xxl my-3 px-0">
       <h4 class="fw-bold">{{ heading }}</h4>
   </div>
</template>

<script>
export default {
    name: "PageHeading",
    props: {
        heading: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
