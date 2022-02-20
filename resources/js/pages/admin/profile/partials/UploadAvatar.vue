<template>
    <form @submit.prevent="uploadAvatar">
        <label for="avatar" class="fw-bold d-flex align-items-center">
            Качане на снимка/лого <span class="text-base-color mx-1" style="cursor: pointer">ТУК</span>
            <i class="bi bi-cloud-plus fs-3"></i>
            <input type="file" class="d-none" id="avatar" name="avatar"/>
        </label>
    </form>
</template>

<script>
export default {
    name: "UploadAvatar"
}
</script>

<style scoped>

</style>
