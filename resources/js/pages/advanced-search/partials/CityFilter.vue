<template>
    <FormKit
        type="select"
        id="cities"
        name="cities"
        label="Град"
        v-model="city"
        placeholder="Изберете град"
        :options="cities.length > 0 ? cities : ['Изберете град']"
    />
</template>

<script>
import {useStore} from "vuex";
import {useFetcher} from "../../../composables/fetcher";
import {computed, watch, ref, onMounted} from "vue";

export default {
    name: "CityFilter",
    setup() {
        const store = useStore();
        const cities = ref([]);

        const city = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['city'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'city', value: value});
            }
        });

        watch(() => store.getters["advancedFilters/getFilters"]['region'], (val) => {
            if (val !== '') {
                fetchCities(val)
            }
        });

        function fetchCities(val) {
            const {fetch} = useFetcher('get.region.cities', [val]);
            cities.value = fetch.value;
        }

        onMounted(() => {
            if (store.getters["advancedFilters/getFilters"]['region'] !== '') {
                fetchCities(store.getters["advancedFilters/getFilters"]['region'])
            }
        });

        return {
            cities,
            city
        }
    }
}
</script>

