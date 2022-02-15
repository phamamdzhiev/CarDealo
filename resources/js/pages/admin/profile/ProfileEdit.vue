<template>
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <form @submit.prevent="handleMobileUpdate">
                    <h6 class="fw-bold">Смяна на мобилен номер</h6>
                    <div class="form-floating form-group">
                        <input type="text" class="form-control form__input"
                               placeholder="Смяна на мобилен номер"
                               name="mobile"
                               v-model.lazy.trim="mobile"
                               id="mobile"
                               required
                        />
                        <label for="mobile">Нов мобилен номер</label>
                        <FromInputValidationMessage v-if="v$.mobile.$error"
                                                    :messages="v$.mobile.$errors"/>
                        <button class="btn base-button">Запази</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-sm-12">
                <form @submit.prevent="handlePasswordUpdate">
                    <h6 class="fw-bold">Промени парола</h6>
                    <div class="form-floating form-group">
                        <input :type="fieldType" class="form-control form__input"
                               placeholder="Стара парола"
                               v-model.lazy.trim="passwordOld"
                               name="passwordOld"
                               id="passwordOld"
                               required
                        />

                        <label for="password">Стара парола</label>

                        <PasswordVisibilityToggle @click="switchVisibility"
                                                  :fieldType="fieldType"></PasswordVisibilityToggle>
                    </div>
                    <div class="form-floating form-group">
                        <input :type="fieldType" class="form-control form__input"
                               placeholder="Стара парола"
                               v-model.lazy.trim="passwordNew"
                               name="passwordNew"
                               id="password"
                               required

                        />
                        <label for="password">Нова парола</label>
                        <PasswordVisibilityToggle @click="switchVisibility"
                                                  :fieldType="fieldType"></PasswordVisibilityToggle>
                    </div>
                    <error-display :errors="errors"></error-display>
                    <button class="btn base-button">Запази</button>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import useVuelidate from '@vuelidate/core';
import {required, maxLength, integer, helpers, minLength} from '@vuelidate/validators';
import FromInputValidationMessage from "../../../components/ui/FromInputValidationMessage";
import PasswordVisibilityToggle from "../../../components/ui/PasswordVisibilityToggle";
import pswVisibilityToggleMixin from "../../../mixins/psw-toggle-visibility";
import ErrorDisplay from "../../../components/ui/ErrorDisplay";

export default {
    name: "ProfileEdit",
    components: {
        FromInputValidationMessage,
        PasswordVisibilityToggle,
        ErrorDisplay
    },
    mixins: [pswVisibilityToggleMixin],
    data() {
        return {
            vuelidateExternalResults: {},
            mobile: null,
            passwordOld: null,
            passwordNew: null,
            v$: useVuelidate(),
            errors: null
        }
    },
    validations() {
        return {
            mobile: {
                integer: helpers.withMessage('Номерът трябва да е във формат 08xxxxxxx', integer),
                minLength: helpers.withMessage('Номерът трябва да бъде 10 цифрен', minLength(10)),
                maxLength: helpers.withMessage('Номерът трябва да бъде 10 цифрен', maxLength(10)),
            }

        }
    },
    inject: ['$toast'],
    methods: {
        async handleMobileUpdate() {
            this.v$.$clearExternalResults();

            const isFormCorrect = await this.v$.$validate();
            if (!isFormCorrect) return;
            try {
                const res = await axios.patch('user/edit/mobile', {mobile: this.mobile});
                if (res.data.success) {
                    this.errors = null;
                    this.mobile = null;
                    this.$toast.open({
                        message: "Успешно променихте номера!",
                        type: 'success',
                        duration: 5000,
                        dismissible: true
                    })
                }
            } catch (e) {
                if (e.response.data.errors) {
                    Object.assign(this.vuelidateExternalResults, {mobile: e.response.data.message.mobile});
                }
            }
        },
        async handlePasswordUpdate() {
            try {
                const res = await axios.patch('user/edit/password',
                    {
                        passwordOld: this.passwordOld,
                        passwordNew: this.passwordNew,
                    }
                );
                if (res.data.success) {
                    this.errors = null;
                    this.passwordOld = null;
                    this.passwordNew = null;
                    this.$toast.open({
                        message: "Успешно променихте паролата!",
                        type: 'success',
                        duration: 5000,
                        dismissible: true
                    })
                }
            } catch (e) {
                if (e.response.data.errors) {
                    this.errors = e.response.data.message
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
