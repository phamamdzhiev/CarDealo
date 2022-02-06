<template>
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-6">
                <div class="base-card py-4 px-5">
                    <h4 class="fw-bold">Вход</h4>
                    <p v-if="isRedirected" class="fw-bold text-warning-color">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        За да качвате обяви трябва да сте логнати
                    </p>
                    <form @submit.prevent="handleLogin">
                        <div class="form-floating form-group">
                            <input type="email" class="form-control form__input"
                                   placeholder="Имейл"
                                   v-model="loginState.email"
                                   id="email"
                            >
                            <label for="email">Имейл или мобилен номер</label>
                            <FromInputValidationMessage v-if="v$.email.$error"
                                                        :messages="v$.email.$errors"/>
                        </div>
                        <div class="form-floating form-group position-relative">
                            <input :type="fieldType" class="form-control form__input"
                                   placeholder="Парола"
                                   v-model="loginState.password"
                                   id="pass"
                            >
                            <label for="pass">Парола</label>
                            <span
                                @click="switchVisibility"
                                style="right: 1rem;"
                                class="position-absolute top-50 translate-middle-y">
                                <i :class="['bi fs-4', { 'bi-eye': fieldType === 'password', 'bi-eye-slash': fieldType === 'text'}]"></i>
                            </span>
                            <FromInputValidationMessage v-if="v$.password.$error"
                                                        :messages="v$.password.$errors"/>
                        </div>
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
            </div>
            <div class="col-lg-6">
                <div class="base-card py-4 px-5">
                    <h4 class="fw-bold">Регистрация</h4>
                    <form @submit.prevent="handleRegister">

                        <div class="form-floating form-group">
                            <input type="text" class="form-control form__input"
                                   placeholder="Име и фамилия"
                                   v-model="registerState.names"
                                   id="names"
                            />
                            <label for="names">Име и фамилия</label>
                            <FromInputValidationMessage v-if="v$R.names.$error"
                                                        :messages="v$R.names.$errors"/>
                        </div>

                        <div class="form-floating form-group">
                            <input type="text" class="form-control form__input"
                                   placeholder="Мобилен номер"
                                   v-model="registerState.mobile"
                                   id="mobile"
                            />
                            <label for="mobile">Мобилен номер</label>
                            <FromInputValidationMessage v-if="v$R.mobile.$error"
                                                        :messages="v$R.mobile.$errors"/>
                        </div>
                        <div class="form-floating form-group">
                            <input type="email" class="form-control form__input"
                                   placeholder="Имейл"
                                   v-model="registerState.email"
                                   id="emailR"
                            />
                            <label for="emailR">Имейл</label>
                            <FromInputValidationMessage v-if="v$R.email.$error"
                                                        :messages="v$R.email.$errors"/>
                        </div>

                        <div class="form-floating form-group position-relative">
                            <input :type="fieldType" class="form-control form__input"
                                   placeholder="Парола"
                                   v-model="registerState.password"
                                   id="passR"
                            >
                            <label for="passR">Парола</label>
                            <FromInputValidationMessage v-if="v$R.password.$error"
                                                        :messages="v$R.password.$errors"/>
                            <span
                                @click="switchVisibility"
                                style="right: 1rem;"
                                class="position-absolute top-50 translate-middle-y">
                                <i :class="['bi fs-4', { 'bi-eye': fieldType === 'password', 'bi-eye-slash': fieldType === 'text'}]"></i>
                            </span>
                        </div>
                        <button class="base-button">
                            <loading-dots v-if="isLoadingR"></loading-dots>
                            <span v-else>Регистрация</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import useVuelidate from "@vuelidate/core";
import {useRouter, useRoute} from "vue-router";
import {useStore} from 'vuex';
import {helpers, required, email, integer, requiredIf} from "@vuelidate/validators";
import {reactive, ref} from "vue";
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import axios from "axios";
import {isUndefined} from "lodash";

export default {
    name: "Login",
    components: {
        BaseCard,
        FromInputValidationMessage
    },
    setup() {
        const router = useRouter();
        const route = useRoute();
        const store = useStore();

        let fieldType = ref('password');
        let errors = ref(null);
        //server-side errors
        let $externalResults = reactive({});

        let isLoading = ref(false);
        let isLoadingR = ref(false);
        let isRedirected = ref(false);

        let loginState = reactive({
            email: null,
            password: null
        });

        let registerState = reactive({
            names: null,
            mobile: null,
            email: null,
            password: null
        });

        function switchVisibility() {
            fieldType.value = fieldType.value === "password" ? "text" : "password";
        }

        if (!isUndefined(route.redirectedFrom) && route.redirectedFrom.name === 'sell.car') {
            isRedirected.value = true;
        }

        const loginValidationRules = {
            email: {
                required: helpers.withMessage('Имейлът е задължителен', required),
                email: helpers.withMessage('Въведете валиден имейл', email)
            },
            password: {required: helpers.withMessage('Паролата е задължителна', required)}
        }

        const registerValidationRules = {
            names: {
                required: helpers.withMessage('Имената са задължителни', required),
            },
            mobile: {
                required: helpers.withMessage('Телефонът е задължителен', required),
                integer: helpers.withMessage('Телефонът трябва да във формат 08хххххххх', integer)
            },
            email: {
                required: helpers.withMessage('Имейлът е задължителен', required),
                email: helpers.withMessage('Въведете валиден имейл', email)
            },
            password: {required: helpers.withMessage('Паролата е задължителна', required)}
        }

        const v$ = useVuelidate(loginValidationRules, loginState);
        const v$R = useVuelidate(registerValidationRules, registerState, {$externalResults});

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

        async function handleRegister() {
            v$R.value.$clearExternalResults();

            if (!await this.v$R.$validate()) return;

            try {
                isLoadingR.value = true;
                const res = await axios.post('auth/register', registerState);
                isLoadingR.value = false;
                if (res.data.success) {
                    await store.dispatch('auth/SET_USER_AUTH_ASYNC', res.data.user);
                    await router.replace({name: 'Home'});
                }
            } catch (e) {
                isLoadingR.value = false;
                Object.assign($externalResults, {
                    email: e.response.data.errors.email,
                    mobile: e.response.data.errors.mobile,
                });
            }
        }

        return {
            v$,
            v$R,
            loginState,
            registerState,
            handleLogin,
            handleRegister,
            errors,
            isLoading,
            isLoadingR,
            isRedirected,
            fieldType,
            switchVisibility
        }
    }
}
</script>
