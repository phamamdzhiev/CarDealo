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
import {computed} from "vue";

export default {
    name: "CityFilter",
    setup() {
        const store = useStore();

        const city = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['city'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'city', value: value});
            }
        });

        const cities = computed(() => {
            if (store.getters["advancedFilters/getFilters"]['region'] === '') {
                return [];
            }

            const {fetch} = useFetcher('get.region.cities', [store.getters["advancedFilters/getFilters"]['region']]);
            return fetch.value
        });

        console.log(cities.value, 'cities')

        return {
            cities,
            city
        }
    }
}
</script>

