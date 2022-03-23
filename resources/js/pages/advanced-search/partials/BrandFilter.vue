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
import {computed} from 'vue';
import {useStore} from "vuex";

export default {
    name: "BrandFilter",
    setup() {
        const store = useStore();

        const brand = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['brand'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'brand', value: value});
            }
        });


        const brands = computed(() => {
            const {fetch} = useFetcher(`vehicle/fetch/brands/${store.getters['advancedFilters/getFilters']['type']}`);
            return fetch.value;
        });

        return {
            brands,
            brand
        }
    }
}
</script>

