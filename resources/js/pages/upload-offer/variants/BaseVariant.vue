<template>
    <div class="sell-car">
        <h1>{{temp}}</h1>
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <FormKit
                type="form"
                submit-label="Следваща стъпка"
                @submit="submitHandler"
                incomplete-message="Моля, попълнете коректно всички задължителни полета"
            >
               <slot/>
            </FormKit>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import PrevStepButton from "../partials/PrevStepButton";
import TopBar from "../TopBar";
export default {
    name: "BaseVariant",
    components: {
        BaseCard,
        PrevStepButton,
        TopBar
    },
    props: ['temp'],
    methods: {
        submitHandler() {
            this.$store.commit('uploadOffer/setStepPlus');
        },
    }
}
</script>

<style scoped>

</style>
