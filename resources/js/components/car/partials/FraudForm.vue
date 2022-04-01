<template>
    <FormKit
        type="form"
        submit-label="Изпрати"
        incomplete-message="Моля, попълнете коректно всички задължителни полета"
        @submit="handleFormSubmit"
    >
        Оферта номер: {{offer.id}}
        <FormKit
            type="email"
            label="Имейл"
            validation="required|email"
        />
        <FormKit
            type="textarea"
            label="Съобщение"
            rows="5"
            placeholder="Опишете какъв е проблема с тази обява"
            validation="required|length:1,5000"
        />
    </FormKit>
</template>

<script>
export default {
    name: "FraudForm",
    props: {
        offer: {
            type: Object,
            required: true
        }
    },
}
</script>
