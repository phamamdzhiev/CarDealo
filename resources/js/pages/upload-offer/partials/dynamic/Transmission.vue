<template>
    <FormKit
        type="select"
        :options="transmissions.length > 0 ? transmissions : ['']"
        id="transmissions"
        name="transmissions"
        label="Трансмисия"
        :placeholder="transmissions.length > 0 ? 'Моля изберете трансмисия' : 'Зареждане...'"
        v-model="transmission"
    />
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";
import {useFetcher} from "../../../../composables/fetcher";

export default {
    name: "Transmission",
    setup() {
        const store = useStore();
        const {fetch: transmissions} = useFetcher('get.transmissions');

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        const transmission = computed({
            get() {
                return getState.value.transmission;
            },
            set(value) {
                store.commit('uploadOffer/setVehicleState', {key: 'transmission', value});
            }
        });

        return {
            getState,
            transmissions,
            transmission,
            store
        }
    }
}
</script>
