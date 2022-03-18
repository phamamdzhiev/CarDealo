<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <div class="question-section mb-4">
                <Engine/>
            </div>
            <div class="question-section mb-4">
                <Transmission/>
            </div>
            <FormKit
                type="form"
                submit-label="Следваща стъпка"
                @submit="submitHandler"
                incomplete-message="Моля, попълнете коректно всички задължителни полета"
            >
                <div class="question-section">
                    <Heading title="Кубатура, мощност, пробег?"/>
                    <FormKit
                        type="number"
                        id="hp"
                        name="hp"
                        label="Мощност"
                        validation="required|number|max:2000|min:1"
                        help="в конски сили"
                        v-model.lazy="hp"
                    />
                    <FormKit
                        type="number"
                        id="km"
                        name="km"
                        label="Пробег"
                        help="в километри"
                        validation="required|number|max:999999|min:1"
                        v-model.lazy="km"
                    />
                    <FormKit
                        type="number"
                        id="cm3"
                        name="cm3"
                        label="Кубатура"
                        validation="required|number|max:9999|min:1"
                        v-model.lazy="cm3"
                    />
                </div>
            </FormKit>

            <!--            <div class="question-se>ction">-->
            <!--                <div class="form-floating form-group">-->
            <!--                    <input type="number" id="cm3" class="form-control form__input"-->
            <!--                           v-model.number="carCm3"-->
            <!--                           placeholder="Кубатура"-->
            <!--                    />-->
            <!--                    <label for="cm3">Кубатура</label>-->
            <!--                    <FromInputValidationMessage v-if="v$.carCm3.$error"-->
            <!--                                                :messages="v$.carCm3.$errors"-->
            <!--                    />-->
            <!--                </div>-->
            <!--                <div class="form-floating form-group">-->
            <!--                    <input type="number" id="horsepower" class="form-control form__input"-->
            <!--                           v-model.number="carHp"-->
            <!--                           placeholder="Мощност (к.с)"-->
            <!--                    />-->
            <!--                    <label for="horsepower">Мощност (к.с)</label>-->
            <!--                    <FromInputValidationMessage v-if="v$.carHp.$error"-->
            <!--                                                :messages="v$.carHp.$errors"-->
            <!--                    />-->
            <!--                </div>-->
            <!--                <div class="form-floating form-group">-->
            <!--                    <cleave-->
            <!--                        id="km" class="form-control form__input"-->
            <!--                        v-model.number="carKm"-->
            <!--                        placeholder="Пробег (км.)"-->
            <!--                        :options="{  numeral: true, delimiter: ' ', numeralThousandsGroupStyle: 'thousand'}"-->
            <!--                    />-->
            <!--&lt;!&ndash;                    <input type="number" id="km" class="form-control form__input"&ndash;&gt;-->
            <!--&lt;!&ndash;                           v-model.number="carKm"&ndash;&gt;-->
            <!--&lt;!&ndash;                           placeholder="Пробег (км.)"&ndash;&gt;-->
            <!--&lt;!&ndash;                    />&ndash;&gt;-->
            <!--                    <label for="horsepower">Пробег (км.)</label>-->
            <!--                    <FromInputValidationMessage v-if="v$.carKm.$error"-->
            <!--                                                :messages="v$.carKm.$errors"-->
            <!--                    />-->
            <!--                </div>-->
            <!--            </div>-->
        </base-card>
    </div>
</template>

<!-- get /set compute -->
<script>
import BaseCard from "../../../components/ui/base/BaseCard.vue";
import TopBar from "../TopBar";
import FromInputValidationMessage from "../../../components/ui/FromInputValidationMessage";
import PrevStepButton from "../partials/PrevStepButton";
import NextStepButton from "../partials/NextStepButton";
import Engine from "../partials/dynamic/Engine";
import Transmission from "../partials/dynamic/Transmission";
import FormField from "../../../components/ui/forms/FormField";
import Heading from "../partials/Heading";
import {computed, onBeforeUnmount, onMounted, ref} from "vue";
import {useStore} from "vuex";

export default {
    name: "SellCarVariant",
    components: {
        TopBar,
        BaseCard,
        FromInputValidationMessage,
        PrevStepButton,
        NextStepButton,
        Engine,
        Transmission,
        FormField,
        Heading
    },
    setup() {
        const store = useStore();

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        const hp = computed({
            get: () => {
                return getState.value.hp;
            },
            set: (val) => {
                setState({key: 'hp', value: val})
            }
        });

        const km = computed({
            get: () => {
                return getState.value.km;
            },
            set: (val) => {
                setState({key: 'km', value: val})
            }
        });

        const cm3 = computed({
            get: () => {
                return getState.value.cm3;
            },
            set: (val) => {
                setState({key: 'cm3', value: val})
            }
        });

        function setState(state) {
            store.commit('uploadOffer/setVehicleState', state);
        }

        function submitHandler() {
            if (getState.value.engine.id === null) {
                alert('Моля изберете гориво');
                return;
            }

            if (getState.value.transmission.id === null) {
                alert('Моля изберете трансмисия');
                return;
            }

            store.commit('uploadOffer/setStepPlus');
        }

        return {
            getState,
            store,
            hp,
            km,
            cm3,
            setState,
            submitHandler
        }
    }
    // data() {
    //     return {
    //         v$: useVuelidate(),
    //         errors: {
    //             errorCm3: false,
    //             errorHp: false,
    //             errorKm: false,
    //         },
    //         engines:[
    //
    //         ]
    //     }
    // },
    // validations() {
    //     return {
    //         carHp: {
    //             required: helpers.withMessage('Задължително поле', required),
    //             maxValue: helpers.withMessage('Въведете реални конски сили', maxValue(2500)),
    //             minValue: helpers.withMessage('Въведете реални конски сили', minValue(20)),
    //         },
    //         carCm3: {
    //             required: helpers.withMessage('Задължително поле', required),
    //             maxValue: helpers.withMessage('Въведете реална кубатура', maxValue(8000)),
    //             minValue: helpers.withMessage('Въведете реална кубатура', minValue(1)),
    //         },
    //         carKm: {
    //             required: helpers.withMessage('Задължително поле', required),
    //             maxValue: helpers.withMessage('Въведете реален пробег', maxValue(999999)),
    //             minValue: helpers.withMessage('Въведете реален пробег', minValue(1)),
    //         }
    //     }
    // },
    // computed: {
    //     getState() {
    //       return this.$store.getters['uploadOffer/getState'];
    //     },
    //     ...mapGetters('sellCar', ['getAllData']),
    //     carHp: {
    //         get() {
    //             return this.getAllData['car_hp'];
    //         },
    //         set(val) {
    //             this.setCarHp(val);
    //         }
    //     },
    //     carCm3: {
    //         get() {
    //             return this.getAllData['car_cm3'];
    //         },
    //         set(val) {
    //             this.setCarCm3(val);
    //         }
    //     },
    //     carKm: {
    //         get() {
    //             return this.getAllData['car_km'];
    //         },
    //         set(val) {
    //             this.setCarKm(val);
    //         }
    //     },
    //     toggleNextStepButton() {
    //         return !!(this.getAllData['car_transmission'] &&
    //             this.getAllData['car_fuel'] &&
    //             this.getAllData['car_cm3'] &&
    //             this.getAllData['car_hp'] &&
    //             this.getAllData['car_km']
    //         );
    //     }
    // },
    // methods: {
    //     ...mapMutations('sellCar', [
    //             'setStepMinus',
    //             'setStepPlus',
    //             'setCarFuel',
    //             'setCarTransmission',
    //             'setCarCm3',
    //             'setCarHp',
    //             'setCarKm'
    //         ]
    //     ),
    //
    //     async showStepFive() {
    //         const isFormCorrect = await this.v$.$validate();
    //         if (!isFormCorrect) return;
    //
    //         this.setStepPlus();
    //     }
    // }
}
</script>

