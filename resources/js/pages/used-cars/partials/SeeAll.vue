<template>
    <div class="see-more pt-3 mt-3">
        <a href="/" class="d-inline-block text-link-blue ps-1">
            {{ message }}
        </a>
    </div>
</template>

<script>
export default {
    name: "SeeAll",
    props: {
        message: {
            required: true
        }
    }
}
</script>

<style scoped>
.see-more {
    border-top: 1px solid #c6c6c6
}

.see-more a {
    font-size: 15px;
}
</style>
