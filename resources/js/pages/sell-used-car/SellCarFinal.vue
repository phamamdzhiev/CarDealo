<template>
    <div class="sell-car">
        <base-card>
            <h3>Готови сте!</h3>
            <base-button @click="navigateToHomepage" link="">Към начална страница</base-button>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import BaseButton from "../../components/ui/base/BaseButton";
import {mapMutations} from "vuex";

export default {
    name: "SellCarFinal",
    components: {
        BaseButton,
        BaseCard
    },
    methods: {
        ...mapMutations('sellCar', ['setCarBrand']),
        navigateToHomepage() {
            this.setCarBrand(null);
            sessionStorage.removeItem('sellCar');
            this.$router.replace('/');
        }
    }
}
</script>

<style scoped>

</style>
