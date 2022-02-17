<template>
    <div class="mt-4">
        <hr>
        <h5 class="fw-bold text-center mb-4">Моля въведете кода, който получихте</h5>
        <form @submit.prevent="handlePasswordReset">
            <div class="form-floating form-group mb-0">
                <input type="text" class="form-control form__input"
                       placeholder="6-цифрен код"
                       id="passwordResetCode"
                       v-model.lazy.trim="v.code.$model"

                />
                <label for="passwordResetCode">6-цифрен код</label>
                <FromInputValidationMessage v-if="v.code.$error"
                                            :messages="v.code.$errors"></FromInputValidationMessage>
                <button class="d-block base-button text-center">Възстанови парола</button>
            </div>
        </form>
    </div>
</template>

<script>
import {reactive, ref} from 'vue'
import { useRouter } from "vue-router";
import useVuelidate from "@vuelidate/core";
import {required, integer, minLength, maxLength, helpers} from "@vuelidate/validators";
import FromInputValidationMessage from "../../../components/ui/FromInputValidationMessage";
import axios from "axios";

export default {
    name: "EnterResetPasswordCode",
    components: {
        FromInputValidationMessage
    },
    props: {
      email: {
          required: true,
          type: String
      }
    },
    setup(props) {
        const validations = {
            code: {
                required: helpers.withMessage('Това е задължително поле', required),
                integer: helpers.withMessage('Кодът съдържа само цифри', integer),
                maxLength: helpers.withMessage('Кодът е с дължина 6 цифри', maxLength(6)),
                minLength: helpers.withMessage('Кодът е с дължина 6 цифри', minLength(6)),
            }
        }

        const router = useRouter();

        const state = reactive({
            code: null
        })
        const externalResults = reactive({})

        const v = useVuelidate(validations, state, {$externalResults: externalResults});

        async function handlePasswordReset() {
            v.value.$clearExternalResults()
            // check if everything is valid
            if (!await v.value.$validate()) return

            try {
                await axios.post('password/reset', {code: state.code});
            //    check if code exist ...

                if (true) {

                }
            } catch (e) {
                console.log(e, 'Reset password cannot be proceed');
            }
        }

        return {
            state,
            v,
            handlePasswordReset
        }
    }
}
</script>
