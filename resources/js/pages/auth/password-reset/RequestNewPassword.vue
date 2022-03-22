<template>
    <div class="base-card custom-container-xs">
        <h5 class="fw-bold text-center mb-4">Възстановяване на забравена парола</h5>
        <form @submit.prevent="handlePasswordRequest">
            <div class="form-floating form-group mb-0">
                <cleave v-model.lazy.trim="state.mobile"
                        class="form-control form__input"
                        name="mobile"
                        placeholder="Мобилен номер"
                        id="mobile"
                        type="tel"
                        :options="{prefix: '+359', blocks: [4, 3, 4, 3]}"
                />
                <!--                    <input type="text"-->
                <!--                           placeholder="Мобилен номер"-->
                <!--                           v-model.lazy.trim="state.mobile"-->
                <!--                           id="mobile"-->
                <!--                           class="form-control form__input"-->
                <!--                    />-->
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
</template>

<script>
import {reactive, ref} from "vue";
import {useRouter} from "vue-router";
import {helpers, required, minLength} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import FromInputValidationMessage from "../../../components/ui/FromInputValidationMessage";
import axios from "axios";
import Cleave from 'vue-cleave-component';

export default {
    name: "RequestNewPassword",
    components: {
        FromInputValidationMessage,
        Cleave
    },
    setup() {
        const router = useRouter();
        const state = reactive({
            mobile: null
        });
        const isLoading = ref(false);
        const mobileFieldRules = {
            mobile: {
                required: helpers.withMessage('Полето е задължително', required),
                minLength: helpers.withMessage('Въведете валиден номер', minLength(14)),
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
                        params: {token: res.data.token, mobile: state.mobile}
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
.disabled {
    pointer-events: none;
    opacity: 0.7;
}
</style>
