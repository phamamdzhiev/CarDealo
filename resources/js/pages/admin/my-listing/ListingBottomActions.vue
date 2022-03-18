<template>
    <div class="actions text-end position-absolute bottom-0 end-0 d-flex align-items-center">
        <div>
            <p class="mb-0 me-3 fw-bold">Промотирай</p>
        </div>
        <router-link class=" p-0 me-2" :to="{name: 'edit.listing', params: {uid: item.uid}}">
            <i class="bi bi-pencil-square text-success-color fs-4"></i>
        </router-link>
        <form @submit.prevent="handleDelete(item['id'], index)">
            <button class="btn p-0 me-2">
                <i class="bi bi-trash text-danger-color fs-4"></i>
            </button>
        </form>
        <p class="text-secondary-color mb-0">
            <i class="bi bi-eye text-secondary fs-4"></i>{{ item['visits'] }}
        </p>
    </div>
</template>

<script>
export default {
    name: "ListingBottomActions",
    props: {

    }
}
</script>

<style scoped>

</style>
