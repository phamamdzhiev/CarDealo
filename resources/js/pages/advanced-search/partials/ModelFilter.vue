<template>
    <FormKit
        type="select"
        label="Модел"
        placeholder="Изберете модел"
        id="models"
        name="models"
        v-model="model"
        :options="models.length > 0 ? models : ['Изберете модел']"
    />
</template>

<script>
import {useFetcher} from "../../../composables/fetcher";
import {computed, ref, watch} from 'vue';
import {useStore} from "vuex";

export default {
    name: "ModelFilter",
    setup() {
        const store = useStore();
        const models = ref([]);

        const model = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['model'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'model', value: value});
            }
        });

        watch(() => store.getters['advancedFilters/getFilters']['brand'], (val) => {
            if (val !== '') {
                fetchModel(val)
            }
        });

        function fetchModel(val) {
            const {fetch} = useFetcher('get.brand.models',
                [val, store.getters['advancedFilters/getFilters']['category']]
            );
            models.value = fetch.value
        }

        return {
            models,
            model
        }
    }
}
</script>

