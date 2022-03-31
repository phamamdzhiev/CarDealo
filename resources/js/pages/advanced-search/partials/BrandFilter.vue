<template>
    <FormKit
        type="select"
        label="Марка"
        placeholder="Изберете марка"
        id="brands"
        name="brands"
        v-model="brand"
        :options="brands.length > 0 ? brands : ['Изберете марка']"
    />
</template>

<script>
import {useFetcher} from "../../../composables/fetcher";
import {computed, onMounted, ref, watch} from 'vue';
import {useStore} from "vuex";

export default {
    name: "BrandFilter",
    setup() {
        const store = useStore();
        const brands = ref([]);

        const brand = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['brand'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'brand', value: value});
            }
        });

        watch(() => store.getters['advancedFilters/getFilters']['type'], (val) => {
            if (val !== '') {
                fetchBrands(val)
            }
        });

        function fetchBrands(val) {
            const {fetch} = useFetcher('get.brands', [val]);
            brands.value = fetch.value;
        }

        onMounted(() => {
            if (store.getters['advancedFilters/getFilters']['type'] !== '') {
                fetchBrands(store.getters['advancedFilters/getFilters']['type'])
            }
        })

        return {
            brands,
            brand
        }
    }
}
</script>

