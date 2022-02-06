<template>
    <div class="sell-car">
        <base-card>
            <!--            <div v-if="true">-->
            <!--                <p v-if="GET_OWNER_EMAIL">-->
            <!--                    {{ GET_OWNER_EMAIL }}-->
            <!--                    <button @click="sendVerificationCode" v-show="!isCodeRequested"> Изпрати код</button>-->
            <!--                    <span v-show="isCodeRequested"> Кодът беше изпрате успешно</span>-->
            <!--                </p>-->

            <!--                <form @submit.prevent>-->
            <!--                    <input v-model.number="code" type="text">-->
            <!--                    <button @click="verifyEmail">Верифицирай имейл</button>-->
            <!--                    <span v-if="msg"> {{ msg }} </span>-->
            <!--                </form>-->
            <!--            </div>-->
            <div v-if="true" class="text-center">
                <i class="bi bi-check-circle text-success-color" style="font-size: 5rem"></i>
                <h3 class="mb-4">Поздраления Вие успешно качихте своята обява!</h3>
                <span>Може да видите своите обяви от <router-link :to="{name: 'my.listing'}"
                                                                  class="text-link-blue">ТУК</router-link></span>
                <base-button @click="navigateToHomepage" link="">Към начална страница</base-button>
            </div>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import BaseButton from "../../components/ui/base/BaseButton";
import axios from "axios";
import {mapGetters, mapMutations} from "vuex";

export default {
    name: "SellCarFinal",
    components: {
        BaseButton,
        BaseCard
    },
    data() {
        return {
            msg: null,
            isCodeRequested: false,
            codeVerified: false,
            code: null,
        }
    },
    computed: {
        ...mapGetters('sellCar', ['GET_OWNER_EMAIL']),
    },
    methods: {
        ...mapMutations('sellCar', ['setCarBrand']),

        async sendVerificationCode() {
            try {
                const res = await axios.post('api/generate-email-verification-code', {'email': this.GET_OWNER_EMAIL});
                console.log(res.data['success'])
                if (res.data['success']) {
                    this.isCodeRequested = true;
                }
            } catch (e) {
                console.log(e, 'in sendVerificationCode')
            }
        },

        async verifyEmail() {
            const data = {
                'email': this.GET_OWNER_EMAIL,
                'code': this.code
            }
            try {
                const res = await axios.post('api/verify-email', data);

                if (res.data['success']) {
                    this.codeVerified = true;
                } else if (res.data['error']) {
                    this.msg = res.data['error'];
                }
            } catch (e) {
                console.log(e, 'in verifyEmail')
            }
        },


        navigateToHomepage() {
            this.setCarBrand(null);
            sessionStorage.clear();
            window.location.href = '/';
        }
    }
}
</script>

<style scoped>

</style>
