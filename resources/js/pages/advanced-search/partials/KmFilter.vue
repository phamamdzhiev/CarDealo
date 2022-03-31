<template>
    <FormKit
        type="number"
        placeholder="Моля въведете минимален пробег"
        help="в лева"
        label="Пробег от"
        name="kmMin"
        step="1"
        v-model.lazy="kmMin"
    />
    <FormKit
        type="number"
        placeholder="Моля въведете максимален пробег"
        help="в лева"
        label="Пробег до"
        name="kmMax"
        step="1"
        v-model.lazy="kmMax"
    />
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    name: "KmFilter",
    setup() {
        const store = useStore();

        const kmMin = computed({
            get: () => {
                return store.getters['advancedFilters/getFilters']['kmMin'];
            },
            set: (val) => {
                store.commit('advancedFilters/setFilters', {filter: 'kmMin', value: val});
            }
        });

        const kmMax = computed({
            get: () => {
                return store.getters['advancedFilters/getFilters']['kmMax'];
            },
            set: (val) => {
                store.commit('advancedFilters/setFilters', {filter: 'kmMax', value: val});
            }
        });

        return {
            kmMin,
            kmMax
        }
    }

}
</script>
