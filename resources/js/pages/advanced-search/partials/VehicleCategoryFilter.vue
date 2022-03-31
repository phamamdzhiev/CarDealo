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
import {computed, onMounted, ref, watch} from "vue";
import {useStore} from "vuex";

export default {
    name: "VehicleCategoryFilter",
    setup() {
        const store = useStore();
        const categories = ref([]);

        const category = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['category'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'category', value: value});
            }
        });

        watch(() => store.getters['advancedFilters/getFilters']['type'], (val) => {
            fetchCategories(val)
        });

        function fetchCategories(val) {
            const {fetch} = useFetcher('get.types', [val])
            categories.value = fetch.value;
        }

        onMounted(() => {
            fetchCategories(store.getters['advancedFilters/getFilters']['type'])
        })

        return {
            categories,
            category
        }
    }
}
</script>
