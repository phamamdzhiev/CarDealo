<template>
    <div class="base-card custom-container-lg">
        <h4 class="fw-bold mb-4">
            <i class="fa-solid fa-magnifying-glass pe-2"></i>
            Подробно търсене
        </h4>
        <div class="advance-search-wrapper">
            <FormKit
                type="select"
                name="type"
                label="Тип"
                :options="['ts']"
            />
            <FormKit
                type="select"
                name="type"
                label="Състояние"
                :options="['Употребяван', 'Нов', 'На части']"
            />
            <FormKit
                type="select"
                name="type"
                label="Марка"
                :options="['ts']"
            />
        </div>
        <hr>
        <div class="advance-search-wrapper">
            <FormKit
                type="select"
                name="type"
                label="Модел"
                :options="['ts']"
            />
            <FormKit
                type="select"
                name="type"
                label="Категория"
                :options="['ts']"
            />
            <FormKit
                type="select"
                name="type"
                label="Гориво"
                :options="['ts']"
            />
            <FormKit
                type="select"
                name="type"
                label="Трансмисия"
                :options="['ts']"
            />
            <FormKit
                type="select"
                name="type"
                label="Цвят"
                :options="['ts']"
            />
            <FormKit
                type="select"
                name="type"
                label="Област"
                :options="['ts']"
            />
            <FormKit
                type="select"
                name="type"
                label="Град"
                :options="['ts']"
            />
            <FormKit
                type="select"
                name="type"
                label="Качена от"
                :options="['ts']"
            />
            <button class="base-button">Търси</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdvancedSearchNew"
}
</script>

<style scoped>
.advance-search-wrapper {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}
</style>
