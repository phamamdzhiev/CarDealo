<template>
    <div v-if="isSubmit">
        <h5 class="text-center fw-bold mb-3">
            Благодарим Ви за обратната връзка!
        </h5>
    </div>
    <div v-else>
        <FormKit
            type="form"
            submit-label="Изпрати"
            incomplete-message="Моля, попълнете коректно всички задължителни полета"
            @submit="handleFormSubmit"
        >
            <FormKit
                type="email"
                label="Имейл"
                validation="required|email"
                v-model="data.email"
            />
            <FormKit
                type="textarea"
                label="Съобщение"
                v-model="data.message"
                rows="5"
                placeholder="Опишете какъв е проблема с тази обява"
                validation="required|length:1,2000"
            />
        </FormKit>
    </div>
</template>

<script>
import {reactive, ref} from "vue";
import axios from "axios";

export default {
    name: "FraudForm",
    props: {
        offer: {
            type: Object,
            required: true
        }
    },
    setup(props) {
        const isSubmit = ref(false);

        const data = reactive({
            email: null,
            message: null,
            offerID: props.offer.id
        });

        async function handleFormSubmit() {
            try {
                const res = await axios.post('send/fraud/message', data);

                if (res.data.success) {
                    isSubmit.value = true;
                }
            } catch (e) {
                console.log('Cannot send Fraud Message', e);
            }
        }

        return {
            isSubmit,
            data,
            handleFormSubmit
        }
    }
}
</script>
