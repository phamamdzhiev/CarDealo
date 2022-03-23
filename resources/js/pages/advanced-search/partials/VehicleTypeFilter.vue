<template>
    <FormKit
        type="select"
        id="type"
        name="type"
        label="Тип"
        placeholder="Изберете тип"
        v-model="type"
        :options="types.length > 0 ? types : ['Изберете тип']"
    />
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";
import {useFetcher} from "../../../composables/fetcher";

export default {
    name: "VehicleTypeFilter",
    setup() {
        const store = useStore();
        const {fetch: types} = useFetcher('vehicle/fetch/vehicle-types');

        const type = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['type'];
            },
            set(value) {
                store.commit('advancedFilters/resetFilter');
                store.commit('advancedFilters/setFilters', {filter: 'type', value: value});
            }
        });

        return {
            types,
            type
        }
    }
}
</script>
