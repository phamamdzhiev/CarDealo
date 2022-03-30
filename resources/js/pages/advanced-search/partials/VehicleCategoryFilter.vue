<template>
    <FormKit
        type="select"
        id="categories"
        name="categories"
        label="Категория"
        placeholder="Изберете категория"
        :options="categories.length > 0 ? categories : ['Изберете категория']"
        v-model="category"
    />
</template>

<script>
import {useFetcher} from "../../../composables/fetcher";
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    name: "VehicleCategoryFilter",
    setup() {
        const store = useStore();

        const category = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['category'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'category', value: value});
            }
        });
        const categories = computed(() => {
            // const {fetch} = useFetcher(`vehicle/fetch/vehicle-type/${store.getters['advancedFilters/getFilters']['type']}/category`)
            const {fetch} = useFetcher('get.types', [store.getters['advancedFilters/getFilters']['type']])
            return fetch.value;
        });


        return {
            categories,
            category
        }
    }
}
</script>
