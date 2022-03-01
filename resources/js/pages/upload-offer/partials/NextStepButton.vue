<template>
    <button @click="showNextStep()"
            class="base-button"
    >
        Следваща стъпка
    </button>
</template>

<script>
import {useStore} from "vuex";

export default {
    name: "NextStepButton",
    emits: ['stepUpdated'],
    setup(_, {emit}) {
        const store = useStore();

        function showNextStep() {
            emit('stepUpdated');
            store.commit('uploadOffer/setStepPlus');
        }

        return {
            showNextStep
        }
    }
}
</script>

<style scoped>

</style>
