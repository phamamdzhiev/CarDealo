<template>
    <header id="the__header">
        <div class="container-xxl">
            <div
                class="d-flex flex-row flex-nowrap align-items-center justify-content-between inner__header"
            >
                <div class="fs-4 logo">
                    <router-link to="/">
                        <img class="img-fluid" width="135" :src="asset('app-images/logo/Most-cars1.png')" alt="MostCars Logo">
                    </router-link>
                </div>
                <div>
                    <nav id="nav" class="main__nav d-flex flex-nowrap align-items-center">
                        <div v-if="getUser" class="me-3">
                            Здравейте, {{ getUser.name }}!
                            <router-link :to="{name:'Profile'}" class="d-flex flex-nowrap align-items-center">
                                <i class="bi bi-person-circle fs-6"></i>
                                <span class="ms-1">Профил</span>
                            </router-link>
                        </div>
                        <span v-else>
                           <router-link :to="{name: 'login'}" class="me-3">Вход / Регистрация <i class="bi bi-door-open fs-5"></i> </router-link>
                       </span>
                        <base-button :link="'upload'" class="special">+ Публикувай</base-button>
                        <show-favorite-offers/>

                    </nav>
                </div>
            </div>
        </div>
        <div class="container-xxl sub__nav">
            <navigation/>
        </div>
    </header>
</template>

<script>
import BaseButton from "../../ui/base/BaseButton";
import ShowFavoriteOffers from "./partials/ShowFavoriteOffers";
import Navigation from "./partials/Navigation";
import assetMixin from "../../../composables/asset"

export default {
    components: {
        BaseButton,
        ShowFavoriteOffers,
        Navigation
    },
    inject: ['window'],
    mixins: [assetMixin],
    computed: {
        getUser() {
            return this.$store.getters['auth/GET_AUTH_USER'];
        }
    },
    mounted() {
        this.$store.dispatch('auth/SET_USER_AUTH_ASYNC', window.AUTH);
    }
};
</script>

<style scoped>
#nav {
    white-space: nowrap;
}

#nav .base-button {
    margin: 0;
}
</style>
