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
                               v-model="mobile"
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
                <form @submit.prevent="handleMobileUpdate">
                    <h6 class="fw-bold">Промени парола</h6>
                    <div class="form-floating form-group">
                        <input type="password" class="form-control form__input"
                               placeholder="Стара парола"
                               name="passwordOld"
                               id="passwordOld"
                        />

                        <label for="password">Стара парола</label>
                        <!--                        <FromInputValidationMessage v-if="v$.mobile.$error"-->
                        <!--                                                    :messages="v$.mobile.$errors"/>-->
                    </div>
                    <div class="form-floating form-group">
                        <input type="password" class="form-control form__input"
                               placeholder="Стара парола"
                               name="password"
                               id="password"
                        />
                        <label for="password">Нова парола</label>
                        <!--            <FromInputValidationMessage v-if="v$R.names.$error"-->
                        <!--                                        :messages="v$R.names.$errors"/>-->
                    </div>
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

export default {
    name: "ProfileEdit",
    components: {
        FromInputValidationMessage
    },
    data() {
        return {
            vuelidateExternalResults: {},
            mobile: null,
            v$: useVuelidate()
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
        }
    }
}
</script>

<style scoped>

</style>
