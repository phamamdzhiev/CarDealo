<template>
    <FormKit
        type="select"
        id="yearMin"
        name="yearMin"
        label="Година след"
        v-model="yearMin"
        placeholder="Изберете година"
        :options="years"
    />
    <template v-if="$route.name === 'advanced.filters'">
        <FormKit
            type="select"
            id="yearMax"
            name="yearMax"
            label="Година до"
            v-model="yearMax"
            placeholder="Изберете година"
            :options="years"
        />
    </template>
</template>

<script>
import {years} from "../../../helpers/years";
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    name: "YearFilter",
    setup() {
        const store = useStore();

        const yearMin = computed({
            get: () => {
                return store.getters['advancedFilters/getFilters']['yearMin'];
            },
            set: (value) => {
                store.commit('advancedFilters/setFilters', {filter: 'yearMin', value: value});
            }
        });

        const yearMax = computed({
            get: () => {
                return store.getters['advancedFilters/getFilters']['yearMax']
            },
            set: (value) => {
                store.commit('advancedFilters/setFilters', {filter: 'yearMax', value: value});
            }
        });

        return {
            years,
            yearMin,
            yearMax
        }
    }
}
</script>
