<template>
    <FormKit
        type="select"
        id="type"
        name="type"
        label="Категория"
        placeholder="Изберете категория"
        v-model="type"
        :options="types.length > 0 ? types : ['Изберете категория']"
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
        const {fetch: types} = useFetcher('get.categories');

        const type = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['category'];
            },
            set(value) {
                store.commit('advancedFilters/resetFilter');
                store.commit('advancedFilters/setFilters', {filter: 'category', value: value});
            }
        });

        return {
            types,
            type
        }
    }
}
</script>
