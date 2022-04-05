<template>
    <FormKit
        type="select"
        placeholder="Изберете филтър"
        label="Сортирай по"
        name="sortBy"
        :options="options"
        v-model="sort"
    />
</template>

<script>
import {computed, ref} from 'vue'
import {useStore} from "vuex";

export default {
    name: "SortByFilter",
    setup() {
        const store = useStore();
        const options = ref(
            [
                {value: 1, label: 'Цена низходящо'},
                {value: 2, label: 'Цена възходящо'},
                {value: 4, label: 'Пробег низходящо'},
                {value: 5, label: 'Пробег възходящо'},
            ]
        )
        const sort = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['sortBy'];
            },
            set(val) {
                store.commit('advancedFilters/setFilters', {filter: 'sortBy', value: val})
            }
        })

        return {
            options,
            sort
        }
    }
}
</script>
