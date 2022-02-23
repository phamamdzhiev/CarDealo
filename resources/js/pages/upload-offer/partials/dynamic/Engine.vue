<template>
    <Heading title="Двигател?"/>
    <ul id="fuel">
        <li v-for="en in engines"
            :key="en.id"
            :class="{ active: getState.engine.id === en.id}"
            @click="store.commit('carOffer/setState', {key:'engine', value: en})">
            {{ en.name }}
        </li>
    </ul>
</template>

<script>
import {useStore} from "vuex";
import {computed, ref} from "vue";
import Heading from "../Heading";

export default {
    name: "ChooseEngine",
    components: {
      Heading
    },
    setup() {
        const store = useStore();
        const engines = ref([
            {id: 1, name: 'Бензинов'},
            {id: 2, name: 'Дизелов'},
            {id: 3, name: 'Хибриден'},
        ]);

        const getState = computed(() => {
            return store.getters['carOffer/getState'];
        });

        return {
            engines,
            getState,
            store
        }
    }
}
</script>

<style scoped>

</style>
