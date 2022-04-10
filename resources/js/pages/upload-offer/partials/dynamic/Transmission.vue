<template>
    <FormKit
        type="select"
        id="transmissions"
        name="transmissions"
        label="Трансмисия"
        placeholder="Моля изберете трансмисия"
        v-model="transmission"
        :options="transmissions.length > 0 ? transmissions : ['Моля изберете трансмисия']"
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
