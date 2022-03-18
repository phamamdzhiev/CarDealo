<template>
    <FormKit
        type="form"
        submit-label="Запази"
        incomplete-message="Моля, попълнете коректно всички задължителни полета"
    >
        <FormKit
            type="textarea"
            label="Описание на автокъщата"
            rows="5"
            help="до 1500 символа"
        />
    </FormKit>
</template>

<script>
export default {
    name: "Description"
}
</script>

<style scoped>

</style>
