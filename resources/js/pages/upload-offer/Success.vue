<template>
    <div class="sell-car">
        <base-card>
            <div class="text-center">
                <i class="bi bi-check-circle text-success-color" style="font-size: 5rem"></i>
                <h3 class="mb-4">Поздраления Вие успешно качихте своята обява!</h3>
                <div>Може да видите своите обяви от
                    <button class="btn text-link-blue fw-bold p-0" @click="navigateAway('listing')">ТУК</button>
                </div>
                <small>ИЛИ</small>
                <button @click="navigateAway('home')" class="base-button d-block ripple">Към начална страница</button>
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
        navigateAway(to) {
            if (to === 'home') {
                this.$router.replace({name: 'Home'})
            } else if (to === 'listing') {
                this.$router.replace({name: 'my.listing'})
            }
        }
    },
    mounted() {
        this.$store.commit('uploadOffer/resetVehicleState');
    }
}
</script>
