<template>
    <i :class="['bi fs-6',
    { 'bi-square': checkedElements.indexOf(checkedValue) === -1,
    'bi-check-square-fill text-base-color': checkedElements.indexOf(checkedValue) !== -1 }]"></i>
</template>

<script>

export default {
    name: "CustomCheckbox",
    props: {
        checkedElements: {
            required: true
        },
        checkedValue: {
            required: true
        }

    }
}
</script>

<style scoped>
i {
    margin-right: 7px;
    cursor: pointer;
}
</style>
