<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <div class="question-section">
                <Heading :title="`Какъв модел ${getState.brand.name} продаваш?`"/>
                <div class="form-group" style="max-width: 250px;">
                    <FormKit
                        type="search"
                        :placeholder="setPlaceholder"
                        value="Apple Cider"
                        id="search__model"
                        v-model.trim="filteredBrandModel"
                        autocomplete="off"
                    />
                </div>
                <spinner v-if="isLoading"/>
                <ul v-else id="model">
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
import BaseCard from "../../components/ui/base/BaseCard";
import TopBar from "./TopBar";
import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";
import PrevStepButton from "./partials/PrevStepButton";
import Heading from "./partials/Heading";
import NextStepButton from "./partials/NextStepButton";
import axios from "axios";

export default {
    name: "SellCarModel",
    components: {
        Heading,
        TopBar,
        BaseCard,
        PrevStepButton,
        NextStepButton
    },
    setup() {
        const store = useStore();
        const filteredBrandModel = ref(null);
        const brandModels = ref([]);
        const isLoading = ref(false);

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        function setModel(model) {
            store.commit('uploadOffer/setVehicleState', {key: 'model', value: model})
        }

        const filteredModelBySearchField = computed(() => {
            return filteredBrandModel.value
                ? brandModels.value.filter((model) => model.name.toLowerCase().includes(filteredBrandModel.value.toLowerCase()))
                : brandModels.value;
        });

        const setPlaceholder = computed(() => {
            return `Търси модел ${getState.value.brand.name}`;
        });

        async function fetchBrandModelsAPI() {
            try {
                isLoading.value = true;
                const res = await axios.get(`vehicle/fetch/vehicle/${getState.value.brand.id}/category/${getState.value.vehicleCategory}`)
                isLoading.value = false;
                if (res.data) {
                    brandModels.value = res.data;
                }
            } catch (e) {
                isLoading.value = false;
                console.log(e, 'cannot fetch brand models')
            }
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
            filteredBrandModel,
            isLoading
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
