<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <div class="question-section mb-3">
                <Heading title="Изберете екстри"/>
                <ul id="extras">
                    <li
                        v-for="item in vehicleExtras"
                        :key="item.id">
                        {{ item.name }}
                    </li>
                </ul>
            </div>
            <div class="question-section mb-3">
                <SelectField label="Цвят" id="color" :options="colors" @emitFromSelectable="setState"/>
            </div>
            <div class="question-section mb-3">
                <SelectField label="Евро стандарт"
                             id="euroStandard"
                             :options="euroStandards"
                             @emitFromSelectable="setState"/>
            </div>
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
            <NextStepButton/>
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
import {ref} from "vue";
import {useStore} from "vuex";

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

        let vehicleExtras = ref([
            {id: 1, name: "ABS"},
            {id: 2, name: "ESP"},
        ]);

        let colors = ref([
            {id: 1, name: 'Черен'},
            {id: 2, name: 'Бял'},
            {id: 3, name: 'Син'},
            {id: 4, name: 'Лилав'},
        ]);

        let euroStandards = ref([
            {id: 1, name: 'I'},
            {id: 2, name: 'II'},
            {id: 3, name: 'III'},
            {id: 4, name: 'IV'},
            {id: 5, name: 'V'},
            {id: 6, name: 'VI'},
        ]);

        function setState(state) {
            store.commit('uploadOffer/setVehicleState', {key: state.key, value: state.value});
        }

        return {
            vehicleExtras,
            colors,
            setState,
            euroStandards
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

