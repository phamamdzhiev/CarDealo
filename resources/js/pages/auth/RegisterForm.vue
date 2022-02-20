<template>
    <div class="base-card py-4 px-5">
        <h4 class="fw-bold">Регистрация</h4>
        <form @submit.prevent="handleRegister">
            <div class="form-floating form-group">
                <input type="text" class="form-control form__input"
                       placeholder="Име и фамилия"
                       v-model.lazy.trim="registerState.names"
                       id="names"
                />
                <label for="names">Име и фамилия</label>
                <FromInputValidationMessage v-if="v$R.names.$error"
                                            :messages="v$R.names.$errors"/>
            </div>

            <div class="form-floating form-group">
                <cleave
                    class="form-control form__input"
                    placeholder="Мобилен номер"
                    v-model.lazy.trim="registerState.mobile"
                    id="mobile"
                    :options="{prefix: '+359', blocks: [4, 3, 4, 3]}"
                />
                <!--                            <input type="text" class="form-control form__input"-->
                <!--                                   placeholder="Мобилен номер"-->
                <!--                                   v-model.lazy.trim="registerState.mobile"-->
                <!--                                   id="mobile"-->
                <!--                            />-->
                <label for="mobile">Мобилен номер</label>
                <FromInputValidationMessage v-if="v$R.mobile.$error"
                                            :messages="v$R.mobile.$errors"/>
            </div>
            <div class="form-floating form-group">
                <input type="email" class="form-control form__input"
                       placeholder="Имейл (Не задължителен)"
                       v-model.lazy.trim="registerState.email"
                       id="emailR"
                />
                <label for="emailR">Имейл (Не задължителен)</label>
                <FromInputValidationMessage v-if="v$R.email.$error"
                                            :messages="v$R.email.$errors"/>
            </div>
            <div class="form-floating form-group position-relative">
                <input :type="fieldType" class="form-control form__input"
                       placeholder="Парола"
                       v-model.lazy.trim="registerState.password"
                       id="passR"
                >
                <label for="passR">Парола</label>
                <FromInputValidationMessage v-if="v$R.password.$error"
                                            :messages="v$R.password.$errors"/>
                <PasswordVisibilityToggle :field-type="fieldType"
                                          @click="switchVisibility"></PasswordVisibilityToggle>
            </div>
            <div
                class="d-flex justify-content-end align-items-center fw-bold"
                @click="updateAccount"
                style="cursor:pointer;user-select: none;max-width: max-content;margin: 0 0 0 auto;">
                Регистрация като автокъща?
                <input type="checkbox" class="d-none" v-model="registerState.is_business" />
                <div class="ms-2">
                    <svg v-show="!registerState.is_business" xmlns="http://www.w3.org/2000/svg" width="28"
                         height="28"
                         fill="currentColor" class="bi bi-toggle2-off" viewBox="0 0 16 16">
                        <path d="M9 11c.628-.836 1-1.874 1-3a4.978 4.978 0 0 0-1-3h4a3 3 0 1 1 0 6H9z"/>
                        <path d="M5 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1A5 5 0 1 0 5 3a5 5 0 0 0 0 10z"/>
                    </svg>
                    <svg v-show="registerState.is_business" xmlns="http://www.w3.org/2000/svg" width="28"
                         height="28"
                         fill="currentColor" class="bi bi-toggle2-on" viewBox="0 0 16 16">
                        <path
                            d="M7 5H3a3 3 0 0 0 0 6h4a4.995 4.995 0 0 1-.584-1H3a2 2 0 1 1 0-4h3.416c.156-.357.352-.692.584-1z"/>
                        <path d="M16 8A5 5 0 1 1 6 8a5 5 0 0 1 10 0z"/>
                    </svg>
                </div>
            </div>
            <register-business-user v-if="registerState.is_business" :validation="v$R"></register-business-user>
            <button class="base-button">
                <loading-dots v-if="isLoadingR"></loading-dots>
                <span v-else>Регистрация</span>
            </button>
        </form>
    </div>
</template>

<script>
import {useRouter} from "vue-router";
import {useStore} from "vuex";
import {reactive, ref} from "vue";
import {email, helpers, maxLength, minLength, required, requiredIf} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import axios from "axios";
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import PasswordVisibilityToggle from "../../components/ui/PasswordVisibilityToggle";
import Cleave from "vue-cleave-component";
import RegisterBusinessUser from "./RegisterBusinessUser";

export default {
    name: "RegisterForm",
    components: {
        FromInputValidationMessage,
        PasswordVisibilityToggle,
        Cleave,
        RegisterBusinessUser
    },
    setup() {
        const router = useRouter();
        const store = useStore();

        let fieldType = ref('password');
        //server-side errors
        let $externalResults = reactive({});


        let isLoadingR = ref(false);

        let registerState = reactive({
            names: null,
            mobile: null,
            email: null,
            password: null,
            is_business: false
        });

        function switchVisibility() {
            fieldType.value = fieldType.value === "password" ? "text" : "password";
        }

        function updateAccount() {
            registerState.is_business = !registerState.is_business;
        }

        const registerValidationRules = {
            names: {
                required: helpers.withMessage('Имената са задължителни', required),
            },
            mobile: {
                required: helpers.withMessage('Телефонът е задължителен', required),
                minLength: helpers.withMessage('Въведете валиден номер', minLength(14)),
            },
            email: {
                email: helpers.withMessage('Въведете валиден имейл', email)
            },
            password: {
                required: helpers.withMessage('Паролата е задължителна', required),
                minLength: helpers.withMessage('Паролата трябва да бъде минимум 6 символа', minLength(6)),
                maxLength: helpers.withMessage('Паролата трябва да бъде максимум 25 символа', maxLength(25)),
            },
            company: {
                requiredIf: helpers.withMessage('Името на автокъщата е задължително', requiredIf(() => registerState.is_business)),
            },
            companyAddress: {
                requiredIf: helpers.withMessage('Адресът на автокъщата е задължителен', requiredIf(() => registerState.is_business)),
            },
            companyEik: {
                requiredIf: helpers.withMessage('ЕИК/Булстат е задължителен', requiredIf(() => registerState.is_business)),
            }
        }


        const v$R = useVuelidate(registerValidationRules, registerState, {$externalResults});


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
            v$R,
            registerState,
            handleRegister,
            isLoadingR,
            fieldType,
            switchVisibility,
            updateAccount,
        }
    }
}
</script>

<style scoped>

</style>
