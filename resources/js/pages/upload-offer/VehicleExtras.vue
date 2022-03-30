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

                    <spinner v-if="vehicleExtras.length < 1"/>
                    <FormKit
                        v-else
                        type="checkbox"
                        :options="vehicleExtras"
                        name="extras"
                        id="extra"
                    />
<!--                    <ul id="extras" v-else>-->
<!--                        <li-->
<!--                            v-for="item in vehicleExtras"-->
<!--                            :key="item.id">-->
<!--                            <label :for="item.name">-->
<!--                            <span class="pe-1">-->
<!--                                <i :class="['bi fs-6',-->
<!--                                {'bi-square': getState.extras.findIndex(obj => obj.id === item.id) === -1,-->
<!--                                 'bi-check-square-fill text-base-color':  getState.extras.findIndex(obj => obj.id === item.id) > -1-->
<!--                                }]"></i>-->
<!--                            </span>-->
<!--                                <span>-->
<!--                                {{ item.name }}-->
<!--                            </span>-->
<!--                                <template class="d-none">-->
<!--                                 -->
<!--                                </template>-->
<!--                            </label>-->
<!--                        </li>-->
<!--                    </ul>-->
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
import SelectField from "../../components/ui/forms/SelectField";
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
        SelectField
    },
    setup() {
        const store = useStore();
        const route = useRoute();
        const isLoading = ref(false);
        const selectedExtras = ref([]);
        const {fetch: colors} = useFetcher('get.colors');

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

        function setExtras(item) {
            store.commit('uploadOffer/setSelectedExtras', item);
        }

        function submitHandler() {
            if (getState.value.extras.length < 1) {
                alert('Моля, изберете екстри');
                return;
            }
            store.commit('uploadOffer/setStepPlus');
        }

        // const {fetch: vehicleExtras} = useFetcher(`vehicle/fetch/extras/category/${route.params.vehicleID}`);
        const {fetch: vehicleExtras} = useFetcher('get.extras', [route.params.vehicleID]);

        return {
            vehicleExtras,
            colors,
            setState,
            euroStandards,
            selectedExtras,
            setExtras,
            isLoading,
            getState,
            submitHandler
        }
    }
}
// data() {
//     return {
//         showExtraCategory: 1,
//         selectedExtras: [],
//         extra1: [],
//         extra2: [],
//         extra3: [],
//         extra4: [],
//         extra5: [],
//         extra6: [],
//     }
// },
// computed: {
//     ...mapGetters('sellCar', ['getAllData', 'getCarExtrasApi']),
//
//     toggleNextStepButton() {
//         return !!(this.selectedExtras.length > 0 &&
//             this.getAllData['car_category'] &&
//             this.getAllData['car_color']
//         );
//     },
// },
// methods: {
//     ...mapMutations('sellCar', ['setStepMinus', 'setCarColor', 'setCarCategory', 'setStepPlus']),
//
//     showStepSix() {
//         if (!this.toggleNextStepButton) return;
//
//         this.$store.commit('sellCar/setCarExtras', this.selectedExtras);
//         this.setStepPlus();
//     },
// },
</script>
