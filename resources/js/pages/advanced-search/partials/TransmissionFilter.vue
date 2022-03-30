<template>
    <FormKit
        type="select"
        id="transmissions"
        name="transmissions"
        label="Трансмисия"
        placeholder="Изберете трансмисия"
        v-model="transmission"
        :options="transmissions.length > 0 ? transmissions : ['Изберете трансмисия']"
    />
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";
import {useFetcher} from "../../../composables/fetcher";

export default {
    name: "TransmissionFilter",
    setup() {
        const store = useStore();
        const {fetch: transmissions} = useFetcher('get.transmissions');

        const transmission = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['transmission'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'transmission', value: value});
            }
        });

        return {
            transmissions,
            transmission
        }
    }
}
</script>
