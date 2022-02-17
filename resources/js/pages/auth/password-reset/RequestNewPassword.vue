<template>
    <base-card>
        <div>
            <h5 class="fw-bold text-center mb-4">Възстановяване на забравена парола</h5>
            <form @submit.prevent="handlePasswordRequest">
                <div class="form-floating form-group mb-0">
                    <input type="text"
                           placeholder="Мобилен номер"
                           v-model.lazy.trim="state.mobile"
                           id="mobile"
                           class="form-control form__input"
                    />
                    <label for="mobile">Мобилен номер</label>
                </div>
                <FromInputValidationMessage v-if="v$.mobile.$error"
                                            :messages="v$.mobile.$errors"/>
                <button class="base-button ripple">
                    <loading-dots v-if="isLoading"></loading-dots>
                    <span v-else>Въстановяване на парола</span>
                </button>
            </form>
        </div>
        <!--        <enter-reset-password-code :email="state.mobile" v-if="isDisabled"></enter-reset-password-code>-->
    </base-card>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import {reactive, ref} from "vue";
import {useRouter} from "vue-router";
import {helpers, required, integer} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import FromInputValidationMessage from "../../../components/ui/FromInputValidationMessage";
import axios from "axios";

export default {
    name: "RequestNewPassword",
    components: {
        BaseCard,
        FromInputValidationMessage,
    },
    setup() {
        const router = useRouter();
        let state = reactive({
            mobile: null
        });
        let isLoading = ref(false);
        const mobileFieldRules = {
            mobile: {
                required: helpers.withMessage('Полето е задължително', required),
                integer: helpers.withMessage('Номерът трябва да съдържа само цифри', integer),
            },
        }
        const v$ = useVuelidate(mobileFieldRules, state);

        async function handlePasswordRequest() {
            if (!await this.v$.$validate()) return;

            try {
                isLoading.value = true;
                const res = await axios.post('password/request', {mobile: state.mobile});
                isLoading.value = false;
                if (res.data.success) {
                    await router.replace({
                        name: 'Reset.password',
                        query: {token: res.data.token, mobile: state.mobile}
                    });
                }

            } catch (e) {
                isLoading.value = false;
                console.log(e, 'Request password code cannot be sent');
            }
        }

        return {
            handlePasswordRequest,
            state,
            v$,
            isLoading
        }
    }
}
</script>

<style scoped>
.base-card {
    max-width: 500px;
    margin: 1rem auto;
}

.disabled {
    pointer-events: none;
    opacity: 0.7;
}
</style>
