<template>
    <FormKit
        type="select"
        name="type"
        label="Състояние"
        :options="['Употребяван', 'Нов', 'На части']"
    />
</template>

<script>
export default {
    name: "ConditionFilter"
}
</script>
