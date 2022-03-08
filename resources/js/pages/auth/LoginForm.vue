<template>
    <div class="base-card py-4 px-5">
        <h4 class="fw-bold">Вход</h4>
        <p v-if="isRedirected" class="fw-bold text-warning-color">
            <i class="bi bi-exclamation-triangle-fill"></i>
            За да качвате обяви трябва да сте логнати
        </p>
        <form @submit.prevent="handleLogin">
            <div class="form-floating form-group">
                <cleave
                    class="form-control form__input"
                    placeholder="Мобилен номер"
                    v-model.lazy.trim="loginState.mobile"
                    id="mobileLogin"
                    type="tel"
                    :options="{prefix: '+359', blocks: [4, 3, 4, 3]}"
                />
                <!--                            <input type="email" class="form-control form__input"-->
                <!--                                   placeholder="Имейл"-->
                <!--                                   v-model.lazy.trim="loginState.email"-->
                <!--                                   id="email"-->
                <!--                            >-->
                <label for="mobileLogin">Mобилен номер</label>
                <FromInputValidationMessage v-if="v$.mobile.$error"
                                            :messages="v$.mobile.$errors"/>
            </div>
            <div class="form-floating form-group position-relative">
                <input :type="fieldType" class="form-control form__input"
                       placeholder="Парола"
                       v-model.lazy.trim="loginState.password"
                       id="pass"
                >
                <label for="pass">Парола</label>

                <FromInputValidationMessage v-if="v$.password.$error"
                                            :messages="v$.password.$errors"/>
                <PasswordVisibilityToggle :field-type="fieldType"
                                          @click="switchVisibility"></PasswordVisibilityToggle>
            </div>
            <router-link class="text-link-blue" :to="{name: 'Request.password'}">Забравена парола?</router-link>
            <div v-if='errors'>
                <small class='input__error'>
                    <i class="bi bi-exclamation-circle"></i>
                    {{ errors }}
                </small>
            </div>
            <button class="base-button">
                <loading-dots v-if="isLoading"></loading-dots>
                <span v-else>Вход</span>
            </button>
        </form>
    </div>
</template>

<script>
import {reactive, ref} from "vue";
import {isUndefined} from "lodash";
import {helpers, minLength, required} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import axios from "axios";
import PasswordVisibilityToggle from "../../components/ui/PasswordVisibilityToggle";
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import Cleave from "vue-cleave-component";
import {useRoute, useRouter} from "vue-router";
import {useStore} from "vuex";

export default {
    name: "LoginForm",
    components: {
        PasswordVisibilityToggle,
        FromInputValidationMessage,
        Cleave
    },
    setup() {
        const route = useRoute();
        const router = useRouter();
        const store = useStore();


        let fieldType = ref('password');
        let isLoading = ref(false);
        let errors = ref(null);
        let loginState = reactive({
            mobile: null,
            password: null
        });

        let isRedirected = ref(false);


        function switchVisibility() {
            fieldType.value = fieldType.value === "password" ? "text" : "password";
        }

        if (!isUndefined(route.redirectedFrom) && (route.redirectedFrom.name === 'upload' || route.redirectedFrom.name === 'upload.vehicle')) {
            isRedirected.value = true;
        }

        const loginValidationRules = {
            mobile: {
                required: helpers.withMessage('Номерът е задължителен', required),
                minLength: helpers.withMessage('Въведете валиден номер във формат +359 08хххххххх', minLength(14)),
            },
            password: {required: helpers.withMessage('Паролата е задължителна', required)}
        }
        const v$ = useVuelidate(loginValidationRules, loginState);

        async function handleLogin() {
            if (!await this.v$.$validate()) return;

            try {
                isLoading.value = true;
                await axios.get('sanctum/csrf-token');
                const res = await axios.post('auth/login', loginState);
                isLoading.value = false;
                if (res.data.user) {
                    await store.dispatch('auth/SET_USER_AUTH_ASYNC', res.data.user);
                    await router.replace({name: 'Home'});
                }
            } catch (e) {
                isLoading.value = false;
                if (e.response.data.error) {
                    errors.value = e.response.data.message;
                    return;
                }
                console.log(e.response, 'Login failed');
            }
        }

        return {
            v$,
            loginState,
            handleLogin,
            errors,
            isLoading,
            isRedirected,
            fieldType,
            switchVisibility
        }
    }
}
</script>

<style scoped>

</style>
