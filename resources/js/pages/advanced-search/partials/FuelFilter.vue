<template>
    <FormKit
        type="select"
        id="fuels"
        name="fuels"
        label="Гориво"
        placeholder="Изберете гориво"
        v-model="fuel"
        :options="fuels.length > 0 ? fuels : ['Изберете гориво']"
    />
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";
import {useFetcher} from "../../../composables/fetcher";

export default {
    name: "FuelFilter",
    setup() {
        const store = useStore();
        const {fetch: fuels} = useFetcher('fetch/fuels');

        const fuel = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['fuel'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'fuel', value: value});
            }
        });

        return {
            fuels,
            fuel
        }
    }
}
</script>
