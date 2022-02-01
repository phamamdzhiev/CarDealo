<template>
    <div class="d-grid">
        <div class="items" v-for="index in cities" :key="index">
            <!-- <img width="100" :src="'https://ik.imagekit.io/gaicl5qj9hl/' + index.img"/> -->
            <p class="fw-bold fs-6 m-0">{{ index.name }}</p>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            cities: [
                {name: 'София'},
                {name: 'Пловдив'},
                {name: 'Варна'},
                {name: 'Бургас'},
                {name: 'Русе'},
                {name: 'Стара Загора'},
                {name: 'Плевен'},
                {name: 'Ямбол'},
                {name: 'Пазарджик'},
                {name: 'Благоевград'},
                {name: 'Велико Търново'},
                {name: 'Видин'},
            ]
        }
    }
}
</script>
<style scoped>
.d-grid {
    grid-template-columns: repeat(auto-fit, minmax(195px, 1fr));
    grid-template-rows: 1fr 1fr;
    justify-content: center;
    gap: 10px 15px;
}

.items {
    text-align: center;
    height: 150px;
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
