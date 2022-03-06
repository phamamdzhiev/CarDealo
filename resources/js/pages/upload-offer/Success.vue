<template>
    <div class="sell-car">
        <base-card>
            <div class="text-center">
                <i class="bi bi-check-circle text-success-color" style="font-size: 5rem"></i>
                <h3 class="mb-4">Поздраления Вие успешно качихте своята обява!</h3>
                <div>Може да видите своите обяви от
                    <router-link :to="{name: 'my.listing'}"
                                 class="text-link-blue">
                        ТУК
                    </router-link>
                </div>
                <base-button @click="navigateToHomepage" link="">Към начална страница</base-button>
            </div>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import BaseButton from "../../components/ui/base/BaseButton";

export default {
    name: "Success",
    components: {
        BaseButton,
        BaseCard,
    },
    methods: {
        navigateToHomepage() {
            sessionStorage.removeItem('offer');
            this.$router.replace({name: 'Home'})
        }
    },
    mounted() {
        this.$store.commit('uploadOffer/resetVehicleState');
    }
}
</script>

<style scoped>

</style>
