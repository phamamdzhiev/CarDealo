<template>
    <div class="d-grid">
        <div class="items" v-for="item in items" :key="item">
            <!-- <img width="100" :src="'https://ik.imagekit.io/gaicl5qj9hl/' + index.img"/> -->
            <p class="fw-bold fs-6 m-0">{{ item.name }}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        items: {
            required: true
        }
    }
}
</script>
<style scoped>
.d-grid {
    grid-template-columns: repeat(auto-fill, minmax(195px, 1fr));
    justify-content: center;
    gap: 10px 15px;
}

.items {
    text-align: center;
    height: 150px;
    max-width: 230px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-evenly;
    align-items: center;
    box-shadow: 0 1px 3px rgb(36 39 44 / 15%);
    border-radius: 4px;
}

.items:hover {
    box-shadow: 0 4px 8px 0 rgb(36 39 44 / 10%), 0 2px 2px 0 rgb(36 39 44 / 10%);
}
</style>
