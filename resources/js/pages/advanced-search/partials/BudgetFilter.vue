<template>
    <FormKit
        type="number"
        placeholder="Моля въведете минимален бюджет"
        help="в лева"
        label="Бюджет от"
        name="budgetMin"
        step="1"
        v-model.lazy="budgetMin"
    />
    <FormKit
        type="number"
        placeholder="Моля въведете максимален бюджет"
        help="в лева"
        label="Бюджет до"
        name="budgetMax"
        step="1"
        v-model.lazy="budgetMax"
    />
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    name: "BudgetFilter",
    setup() {
        const store = useStore();

        const budgetMin = computed({
            get: () => {
                return store.getters['advancedFilters/getFilters']['budgetMin'];
            },
            set: (val) => {
                store.commit('advancedFilters/setFilters', {filter: 'budgetMin', value: val});
            }
        });

        const budgetMax = computed({
            get: () => {
                return store.getters['advancedFilters/getFilters']['budgetMax'];
            },
            set: (val) => {
                store.commit('advancedFilters/setFilters', {filter: 'budgetMax', value: val});
            }
        });

        return {
            budgetMin,
            budgetMax
        }
    }
}
</script>
