<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <div class="question-section">
                <Heading :title="`Какъв модел ${getState.brand.name} продаваш?`"/>
                <div class="form-group">
                    <input
                        type="text"
                        id="search__model"
                        class="form__input"
                        :placeholder="setPlaceholder"
                        v-model.trim="filteredBrandModel"
                    />
                </div>
                <ul id="model">
                    <li
                        v-for="model in filteredModelBySearchField"
                        :key="model.id"
                        :class="{ active: model.id === getState.model.id }"
                        @click="setModel(model)"
                    >
                        {{ model.name }}
                    </li>
                </ul>
            </div>
            <NextStepButton v-if="getState.model.id"/>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import TopBar from "../TopBar";
import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";
import PrevStepButton from "../partials/PrevStepButton";
import Heading from "../partials/Heading";
import NextStepButton from "../partials/NextStepButton";

export default {
    name: "VehicleModel",
    components: {
        Heading,
        TopBar,
        BaseCard,
        PrevStepButton,
        NextStepButton
    },
    setup() {
        const store = useStore();

        let filteredBrandModel = ref(null);

        let brandModels = ref([
            {id: 1, name: 'A3'},
            {id: 2, name: 'A7'},
            {id: 3, name: 'A8'},
        ]);

        const getState = computed(() => {
            return store.getters['uploadOffer/getState'];
        });

        function setModel(model) {
            store.commit('uploadOffer/setState', {key: 'model', value: model})
        }

        const filteredModelBySearchField = computed(() => {
            return filteredBrandModel.value
                ? brandModels.value.filter((model) => model.name.toLowerCase().includes(filteredBrandModel.value.toLowerCase()))
                : brandModels.value;
        });

        const setPlaceholder = computed(() => {
            return `Търси модел ${getState.value.brand.name}`;
        });

        function fetchBrandModelsAPI() {
            console.log('Model id (VehicleMode.vue)', getState.value.brand.id);
        }

        onMounted(() => {
            fetchBrandModelsAPI()
        });

        return {
            getState,
            brandModels,
            setModel,
            setPlaceholder,
            filteredModelBySearchField,
            filteredBrandModel
        }
    }
    // data() {
    //     return {
    //         search: null,
    //     };
    // },
    // methods: {
    //     ...mapMutations('sellCar', ["setStepMinus", "setStepPlus", "setCarModel", "setSelectedCarModelID"]),
    //
    //     showStepFour() {
    //         if (!this.getAllData['car_model']) return;
    //         this.setStepPlus();
    //     },
    //
    // },
    //
    // computed: {
    //     ...mapGetters('sellCar', ["getAllData", "getCarBrandWithModels"]),
    //
    //
    //
    //     filteredCarModelBySearchField() {
    //         if (this.search) {
    //             // this.setCarModel(null);
    //             this.search = this.search.toLowerCase();
    //             return this.getCarBrandWithModels.filter((model) =>
    //                 model.name.toLowerCase().includes(this.search)
    //             );
    //         } else {
    //             return this.getCarBrandWithModels;
    //         }
    //     },
    // },
};
</script>

<style scoped>
a {
    display: block;
}
</style>
