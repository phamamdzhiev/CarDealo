<template>
    <FormKit
        type="select"
        id="types"
        name="types"
        label="Тип"
        placeholder="Изберете тип"
        :options="types.length > 0 ? types : ['Изберете тип']"
        v-model="type"
    />
</template>

<script>
import {useFetcher} from "../../../composables/fetcher";
import {computed, onMounted, ref, watch} from "vue";
import {useStore} from "vuex";

export default {
    name: "VehicleCategoryFilter",
    setup() {
        const store = useStore();
        const types = ref([]);

        const type = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['type'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'type', value: value});
            }
        });

        watch(() => store.getters['advancedFilters/getFilters']['category'], (val) => {
            fetchTypes(val)
        });

        function fetchTypes(val) {
            const {fetch} = useFetcher('get.types', [val])
            types.value = fetch.value;
        }

        onMounted(() => {
            fetchTypes(store.getters['advancedFilters/getFilters']['category'])
        })

        return {
            types,
            type
        }
    }
}
</script>
