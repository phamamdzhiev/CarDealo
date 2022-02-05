<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 ps-0">
                <div class="base-card py-4 px-5">
                    <h4 class="fw-bold">Вход</h4>
                    <p>За да качвате обяви трябва да сте регистриран</p>
                    <form @submit.prevent="handleLogin">
                        <div class="form-floating form-group">
                            <input type="text" class="form-control form__input"
                                   placeholder="Имейл"
                                   v-model="loginState.email"
                                   id="email"
                            >
                            <label for="email">Имейл или мобилен номер</label>
                            <FromInputValidationMessage v-if="v$.email.$error"
                                                        :messages="v$.email.$errors"/>
                        </div>
                        <div class="form-floating form-group">
                            <input type="password" class="form-control form__input"
                                   placeholder="Парола"
                                   v-model="loginState.password"
                                   id="pass"
                            >
                            <label for="pass">Парола</label>
                        </div>
                        <button class="base-button">Вход</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 pe-0">
                <div class="base-card px-5">
                    <h4>Регистрация</h4>
                    <p>За да качвате обяви трябва да сте регистриран</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import useVuelidate from "@vuelidate/core";
import {helpers, required, email} from "@vuelidate/validators";
import {reactive, ref} from "vue";
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import axios from "axios";

export default {
    name: "Login",
    components: {
        BaseCard,
        FromInputValidationMessage
    },
    setup() {
        let loginState = reactive({
            email: null,
            password: null
        });

        const loginValidationRules = {
            email: {
                required: helpers.withMessage('Имейлът е задължителен', required),
                email: helpers.withMessage('Въведете валиден имейл', email)
            },
            password: { required }
        }

        const v$ = useVuelidate(loginValidationRules, loginState);

        async function handleLogin() {
            const isFormCorrect = await this.v$.$validate();
            if (!isFormCorrect) return;

            // let loginData = {
            //     'email': loginEmail.value,
            //     'password': loginPassword.value
            // }

            // await axios.post('auth/login', loginData);
        }
        return {
            v$,
            loginState,
            handleLogin
        }
    }
}
</script>

<style scoped>

</style>
