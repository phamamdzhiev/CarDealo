<template>
    <div class="d-grid">
        <div class="item">
            Дизелов
        </div>
        <div class="item">
            Бензинов
        </div>
        <div class="item">
            CNG (Газ)
        </div>
        <div class="item">
            Хибриден
        </div>
        <div class="item">
            Електрически
        </div>
    </div>
</template>

<script>
export default {
    name: "PopularEngines"
}
</script>

<style scoped>
.d-grid {
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
}
.item {
    text-align: center;
    height: 150px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-evenly;
    align-items: center;
    box-shadow: 0 1px 3px rgb(36 39 44 / 15%);
    border-radius: 4px;
}
.item:hover {
    box-shadow: 0 4px 8px 0 rgb(36 39 44 / 10%), 0 2px 2px 0 rgb(36 39 44 / 10%);
}
</style>
