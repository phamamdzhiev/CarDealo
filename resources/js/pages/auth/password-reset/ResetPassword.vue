<template>
    <base-card>
        <h5 class="fw-bold text-center mb-4">Възстановяване на забравена парола</h5>
        <form @submit.prevent="handlePasswordReset">
            <div class="form-floating form-group">
                <input :type="fieldType"
                       placeholder="Нова парола"
                       v-model.lazy.trim="v$.password.$model"
                       id="password"
                       class="form-control form__input"
                />
                <label for="password">Нова парола</label>
                <PasswordVisibilityToggle :field-type="fieldType"
                                          @click="switchVisibility"></PasswordVisibilityToggle>
                <FromInputValidationMessage v-if="v$.password.$error"
                                            :messages="v$.password.$errors"/>
            </div>
            <div class="form-floating form-group">
                <input type="text"
                       placeholder="6-цифрен код"
                       v-model.lazy.trim="v$.code.$model"
                       id="code"
                       class="form-control form__input"
                />
                <label for="code">6-цифрен код</label>
                <FromInputValidationMessage v-if="v$.code.$error"
                                            :messages="v$.code.$errors"/>
            </div>
            <button class="base-button ripple">
                <loading-dots v-if="isLoading"></loading-dots>
                <span v-else>Запази</span>
            </button>
        </form>
    </base-card>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import PasswordVisibilityToggle from "../../../components/ui/PasswordVisibilityToggle";
import FromInputValidationMessage from "../../../components/ui/FromInputValidationMessage";
import axios from "axios";
import useVuelidate from "@vuelidate/core";
import {helpers, required, minLength, maxLength, integer} from "@vuelidate/validators";

export default {
    name: "ResetPassword",
    components: {
        BaseCard,
        PasswordVisibilityToggle,
        FromInputValidationMessage
    },
    created() {
        console.log(this.$route.params);
    },
    data() {
        return {
            password: null,
            code: null,
            fieldType: 'password',
            isLoading: false,
            v$: useVuelidate(),
            vuelidateExternalResults: {}
        }
    },
    validations() {
        return {
            code: {
                required: helpers.withMessage('Това поле е задължително', required),
                integer: helpers.withMessage('Кодът съдържа само цифри', integer),
                maxLength: helpers.withMessage('Кодът е с дължина 6 цифри', maxLength(6)),
                minLength: helpers.withMessage('Кодът е с дължина 6 цифри', minLength(6)),
            },
            password: {
                required: helpers.withMessage('Това поле е задължително', required),
                maxLength: helpers.withMessage('Паролата трябва да бъде максимум 25 символа', maxLength(25)),
                minLength: helpers.withMessage('Паролата трябва да бъде минимум 6 символа', minLength(6)),
            }
        }
    },
    methods: {
        async handlePasswordReset() {
            this.v$.$clearExternalResults();

            if (!await this.v$.$validate()) return;

            const data = {
                password: this.password,
                code: this.code,
                token: this.$route.params.token,
                mobile: this.$route.params.mobile
            }

            try {
                const res = await axios.post('password/reset', data);
                if (res.data.success) {
                    await this.$router.replace({name: 'login'});
                }
            } catch (e) {
                if (e.response.data) {
                    Object.assign(this.vuelidateExternalResults, {
                        code: e.response.data.code
                    });
                }
            }
        },
        switchVisibility() {
            this.fieldType = this.fieldType === "password" ? "text" : "password";
        }
    }

}
</script>

<style scoped>
.base-card {
    max-width: 500px;
    margin: 1rem auto;
}
</style>
