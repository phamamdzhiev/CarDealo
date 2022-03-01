<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <FormKit
                type="form"
                submit-label="Следваща стъпка"
                @submit="submitHandler"
            >
                <div class="question-section mb-3">
                    <Heading title="Изберете екстри"/>

                    <spinner v-if="isLoading"/>
                    <ul id="extras" v-else>
                        <li
                            v-for="item in vehicleExtras"
                            :key="item.id">
                            <label :for="item.name">
                            <span class="pe-1">
                                <i :class="['bi fs-6',
                                {'bi-square': getState.extras.findIndex(obj => obj.id === item.id) === -1,
                                 'bi-check-square-fill text-base-color':  getState.extras.findIndex(obj => obj.id === item.id) > -1
                                }]"></i>
                            </span>
                                <span>
                                {{ item.name }}
                            </span>
                                <template class="d-none">
                                    <FormKit
                                        @change="setExtras(item)"
                                        type="checkbox"
                                        :label="item.name"
                                        name="extras"
                                        :id="item.name"
                                    />
                                </template>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="question-section mb-3">
                    <FormKit
                        v-if="colors.length > 0"
                        type="select"
                        id="color"
                        name="color"
                        label="Цвят"
                        placeholder="Моля изберете Цвят"
                        :options="colors"
                        @change="setState($event.target)"
                        validation="required"
                    />
                </div>
                <div class="question-section mb-3">
                    <FormKit
                        v-if="euroStandards.length > 0"
                        type="select"
                        id="euro-standard"
                        name="euro-standard"
                        label="Евро стандарт"
                        placeholder="Моля изберете Евро стандарт"
                        :options="euroStandards"
                        @change="setState($event.target)"
                        validation="required"
                    />
                </div>
            </FormKit>
            <!--            <div class="question-section">-->
            <!--                <div class="form-floating">-->
            <!--                    <select id="floatingSelectCarCategory" v-model="getAllData['car_category']"-->
            <!--                            class="form-select form__input m-0">-->
            <!--                        <option value="Ван">Ван</option>-->
            <!--                        <option value="Джип">Джип</option>-->
            <!--                        <option value="Кабрио">Кабрио</option>-->
            <!--                        <option value="Купе">Купе</option>-->
            <!--                        <option value="Седан">Седан</option>-->
            <!--                        <option value="Комби">Комби</option>-->
            <!--                    </select>-->
            <!--                    <label for="floatingSelectCarCategory">Моля изберете категория</label>-->
            <!--                </div>-->
            <!--            </div>-->
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
import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";
import {FormKit} from "@formkit/vue/index";
import axios from "axios";
import {useRoute} from "vue-router";

export default {
    name: "VehicleExtras",
    components: {
        FormKit,
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

        const vehicleExtras = ref([]);

        const colors = ref([]);

        let euroStandards = ref([
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

        onMounted(() => {
            isLoading.value = true;
            axios.get(`vehicle/fetch/extras/category/${route.params.vehicleID}`)
                .then((res) => {
                    vehicleExtras.value = res.data;
                    isLoading.value = false
                })
                .catch((e) => {
                    console.log('Cannot fetch extras', e);
                    isLoading.value = false
                });

            axios.get('fetch/colors')
                .then((res) => {
                    isLoading.value = false
                    res.data.data.forEach((element) => {
                        colors.value.push({label: element.name, value: element.id});
                    });
                })
                .catch((e) => {
                    console.log('Cannot fetch colors', e);
                    isLoading.value = false
                });
        });

        function submitHandler() {
            if (getState.value.extras.length < 1) {
                alert('Моля, изберете екстри');
                return;
            }
            store.commit('uploadOffer/setStepPlus');
        }

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

<style scoped>
.sell-car {
    max-width: 800px;
}
</style>

