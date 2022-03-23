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
import {computed} from 'vue';
import {useStore} from "vuex";

export default {
    name: "ModelFilter",
    setup() {
        const store = useStore();

        const model = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['model'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'model', value: value});
            }
        });

        const models = computed(() => {
            const {fetch} = useFetcher(`vehicle/fetch/vehicle/${store.getters['advancedFilters/getFilters']['brand']}/category/${store.getters['advancedFilters/getFilters']['type']}`);
            return fetch.value;
        });

        return {
            models,
            model
        }
    }
}
</script>

