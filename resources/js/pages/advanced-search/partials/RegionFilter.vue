<template>
    <FormKit
        type="select"
        id="regions"
        name="regions"
        label="Регион"
        v-model="region"
        placeholder="Изберете регион"
        :options="regions.length > 0 ? regions : ['Изберете регион']"
    />
</template>

<script>
import {computed} from 'vue';
import {useFetcher} from "../../../composables/fetcher";
import {useStore} from "vuex";

export default {
    name: "RegionFilter",
    setup() {
        const store = useStore();
        const {fetch: regions} = useFetcher('fetch/regions');

        const region = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['region'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'region', value: value});
            }
        });

        return {
            regions,
            region
        }
    }
}
</script>
