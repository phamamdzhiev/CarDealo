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
            <register-business-user></register-business-user>
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
import {email, helpers, maxLength, minLength, required} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import axios from "axios";
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import PasswordVisibilityToggle from "../../components/ui/PasswordVisibilityToggle";
import Cleave from "vue-cleave-component";
import RegisterBusinessUser from "../../components/ui/RegisterBusinessUser";

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
            password: null
        });

        function switchVisibility() {
            fieldType.value = fieldType.value === "password" ? "text" : "password";
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
            switchVisibility
        }
    }
}
</script>

<style scoped>

</style>
