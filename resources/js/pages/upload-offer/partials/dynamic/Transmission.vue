<template>
    <Heading title="Трансмисия?"/>
    <ul id="transmission">
        <li v-for="transmission in transmissions" :key="transmission.id"
            :class="{ active: getState.transmission.id === transmission.id}"
            @click="store.commit('uploadOffer/setVehicleState', {key: 'transmission', value:transmission})">
            {{ transmission.name }}
        </li>
    </ul>
</template>

<script>
import Heading from "../Heading";
import {computed, ref} from "vue";
import {useStore} from "vuex";
export default {
    name: "Transmission",
    components: {
        Heading
    },
    setup() {
        const store = useStore();
        const transmissions = ref([
            {id: 1, name: 'Ръчна'},
            {id: 2, name: 'Автоматична'},
            {id: 3, name: 'Полу-автоматична'},
        ]);
        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        return {
            getState,
            transmissions,
            store
        }
    }
}
</script>

<style scoped>

</style>
