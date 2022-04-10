<template>
    <FormKit
        type="select"
        :options="engines.length > 0 ? engines : ['Моля изберете двигател']"
        id="engines"
        name="engines"
        label="Двигател"
        placeholder="Моля изберете двигател"
        v-model="engine"
    />
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";
import {useFetcher} from "../../../../composables/fetcher";

export default {
    name: "ChooseEngine",
    setup() {
        const store = useStore();
        const {fetch: engines} = useFetcher('get.engines')

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        const engine = computed({
            get() {
                return getState.value.engine;
            },
            set(value) {
                store.commit('uploadOffer/setVehicleState', {key: 'engine', value});
            }
        });

        return {
            engines,
            getState,
            store,
            engine
        }
    }
}
</script>
