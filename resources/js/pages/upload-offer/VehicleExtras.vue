<template>
    <div class="sell-car custom-container-md">
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <FormKit
                type="form"
                submit-label="Следваща стъпка"
                @submit="submitHandler"
                incomplete-message="Моля, попълнете коректно всички задължителни полета"
            >
                <div class="question-section mb-3">
                    <Heading title="Изберете екстри"/>
{{setExtras}}
                    <spinner v-if="vehicleExtras.length < 1"/>
                    <FormKit
                        v-else
                        v-model="setExtras"
                        type="checkbox"
                        :options="vehicleExtras"
                        name="extras"
                        validation="required|min:1"
                        id="extra"
                    />
                </div>
                <div class="question-section mb-3">
                    <FormKit
                        type="select"
                        id="color"
                        name="color"
                        label="Цвят"
                        placeholder="Моля изберете Цвят"
                        :options="colors.length > 0 ? colors : ['Цвят']"
                        @change="setState($event.target)"
                        validation="required"
                    />
                </div>
                <div class="question-section mb-3">
                    <FormKit
                        type="select"
                        id="euro-standard"
                        name="euro-standard"
                        label="Евро стандарт"
                        placeholder="Моля изберете Евро стандарт"
                        :options="euroStandards.length > 0 ? euroStandards : ['Евро стандарт']"
                        @change="setState($event.target)"
                        validation="required"
                    />
                </div>
            </FormKit>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard.vue";
import TopBar from "./TopBar";
import PrevStepButton from "./partials/PrevStepButton";
import NextStepButton from "./partials/NextStepButton";
import Heading from "./partials/Heading";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import {useRoute} from "vue-router";
import {useFetcher} from "../../composables/fetcher";

export default {
    name: "VehicleExtras",
    components: {
        TopBar,
        BaseCard,
        PrevStepButton,
        NextStepButton,
        Heading,
    },
    setup() {
        const store = useStore();
        const route = useRoute();
        const isLoading = ref(false);
        const selectedExtras = ref([]);
        const {fetch: colors} = useFetcher('get.colors');
        const {fetch: vehicleExtras} = useFetcher('get.extras', [route.params.vehicleID]);

        const euroStandards = ref([
            {value: 1, label: 'I'},
            {value: 2, label: 'II'},
            {value: 3, label: 'III'},
            {value: 4, label: 'IV'},
            {value: 5, label: 'V'},
            {value: 6, label: 'VI'},
        ]);

        function setState(e) {
            store.commit('uploadOffer/setVehicleState', {key: e.name, value: e.value});
        }

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        const setExtras = computed({
            get: () => {
                return getState.value.extras;
            },
            set: (value) => {
                store.commit('uploadOffer/setSelectedExtras', value);
            }
        })
        // function setExtras(item) {
        //     store.commit('uploadOffer/setSelectedExtras', item);
        // }

        function submitHandler() {
            store.commit('uploadOffer/setStepPlus');
        }

        return {
            vehicleExtras,
            colors,
            setState,
            euroStandards,
            selectedExtras,
            isLoading,
            getState,
            submitHandler,
            setExtras
        }
    }
}
</script>
<style scoped>

</style>
