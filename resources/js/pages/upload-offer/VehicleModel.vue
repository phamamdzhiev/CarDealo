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
            <next-step-button v-if="getState.model.id"/>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import TopBar from "./TopBar";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import PrevStepButton from "./partials/PrevStepButton";
import Heading from "./partials/Heading";
import NextStepButton from "./partials/NextStepButton";
import {useFetcher} from "../../composables/fetcher";

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

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        const {
            isLoading,
            fetch: brandModels
        } = useFetcher('get.brand.models', [getState.value.brand.id, getState.value.vehicleCategory], false);

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
}
</script>

<style scoped>
a {
    display: block;
}
</style>
