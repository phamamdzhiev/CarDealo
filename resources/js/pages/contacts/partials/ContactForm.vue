<template>
    <div>
        <h5 v-if="showSuccessMessage" class="text-center text-success-color fw-bold">
            <i class="fa-solid fa-thumbs-up"></i>
            Вие успешно изпратихте Вашето съощения, очаквайте скоро да се свържем с Вас!
        </h5>
        <FormKit
            v-else
            type="form"
            submit-label="Изпрати запитване"
            id="contacts-form"
            @submit="submitHandler"
            incomplete-message="Моля, попълнете коректно всички задължителни полета"
        >
            <h5 class="fw-bold mb-3">
                <i class="fa-solid fa-envelope-open-text pe-1"></i>
                Форма за запитвания, препоръки и мнение
            </h5>
            <FormKit
                type="text"
                name="name"
                label="Вашето име"
                validation="required"
                v-model="formFields.name"
            />
            <FormKit
                type="email"
                name="email"
                label="Имейл адрес"
                validation="required"
                v-model="formFields.email"
            />
            <FormKit
                type="textarea"
                label="Съощение"
                rows="4"
                validation="required|length:1,5000"
                help="до 5000 символа"
                v-model="formFields.message"
            />
        </FormKit>
    </div>
</template>

<script>
import {reactive, ref} from "vue";
import { reset } from '@formkit/core'

export default {
    name: "ContactForm",
    setup() {
        const showSuccessMessage = ref(false);
        const formFields = reactive({
            name: null,
            email: null,
            message: null,
        });

        async function submitHandler() {
            reset('contacts-form');
            showSuccessMessage.value = true;
            console.log(formFields);
        }

        return {
            submitHandler,
            formFields,
            showSuccessMessage
        }
    }
}
</script>
