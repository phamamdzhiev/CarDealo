<template>
    <div>
        <div>
            <i class="fa-solid fa-link fs-6 pe-1"></i>
        </div>
        <div>
            Линк на обявата:
        </div>
        <div class="d-block mt-2 fw-light">
            {{ $route.path }} -
            <span> <i class="fa-solid fa-copy"></i> Копирай</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "CopyToClipboard"
}
</script>

<style scoped>

</style>
