<template>
    <div @click="showPrevStep" class="back__button mb-3">
        <i class="bi bi-arrow-left-short"></i>
        <span>Назад</span>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    name: "PrevStepButton",
    setup() {
        const store = useStore();

        function showPrevStep() {
            store.commit('uploadOffer/setStepMinus');
        }

        const getStep = computed(() => {
            return store.getters['uploadOffer/getStep'];
        });

        return {
            showPrevStep,
            getStep
        }
    }
}
</script>

<style scoped>

</style>
