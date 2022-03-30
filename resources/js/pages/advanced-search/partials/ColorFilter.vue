<template>
    <FormKit
        type="select"
        id="colors"
        name="color"
        label="Цвят"
        placeholder="Изберете цвят"
        :options="colors.length > 0 ? colors : ['Изберете цвят']"
        v-model="color"
    />
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";
import {useFetcher} from "../../../composables/fetcher";

export default {
    name: "ColorFilter",
    setup() {
        const store = useStore();
        const {fetch: colors} = useFetcher('get.colors');

        /*
         Keeping this here for later
         */

        // const getFilters = computed(() => {
        //     const obj = store.getters['advancedFilters/getFilters'];
        //
        //     Object.keys(obj).forEach(el => {
        //         if (obj[el] === null) {
        //             delete obj[el];
        //         }
        //     });
        //
        //     return obj;
        // });

        const color = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['color'];
            },
            set(value) {
                store.commit('advancedFilters/setFilters', {filter: 'color', value: value});
            }
        });

        return {
            colors,
            color,
        }
    }
}
</script>
