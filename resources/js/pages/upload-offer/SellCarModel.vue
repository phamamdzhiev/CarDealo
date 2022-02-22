<template>
    <div class="sell-car">
        <base-card>
      <span @click="setStepMinus" class="back__button"
      >Назад <i class="fw-light">(Стъпка 1)</i></span
      >
            <TopBar/>
            <div class="question-section">
                <h5 class="fw-bold">
                    Какъв модел {{ getAllData["car_brand"] }} продаваш?
                </h5>
                <div class="form-group">
                    <input
                        type="text"
                        id="search__model"
                        class="form__input"
                        :placeholder="setPlaceholder"
                        v-model.trim="search"
                    />
                </div>

                <ul id="model">
                    <li
                        v-for="model in filteredCarModelBySearchField"
                        :key="model.id"
                        :class="{ active: model.name === getAllData['car_model'] }"
                        @click="chooseModel(model.name, model.id)"
                    >
                        {{ model.name }}
                    </li>
                </ul>
            </div>

            <button
                @click="showStepFour"
                v-if="getAllData['car_model']"
                class="base-button"
            >
                Следваща стъпка
            </button>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import TopBar from "./TopBar";
import {mapGetters, mapMutations} from "vuex";

export default {
    name: "SellCarModel",
    components: {
        TopBar,
        BaseCard,
    },
    data() {
        return {
            search: null,
        };
    },
    methods: {
        ...mapMutations('sellCar', ["setStepMinus", "setStepPlus", "setCarModel", "setSelectedCarModelID"]),

        showStepFour() {
            if (!this.getAllData['car_model']) return;
            this.setStepPlus();
        },
        chooseModel(modelName, modelId) {
            this.setCarModel(modelName);
            this.setSelectedCarModelID(modelId);
        },
    },

    computed: {
        ...mapGetters('sellCar', ["getAllData", "getCarBrandWithModels"]),

        setPlaceholder() {
            return `Търси модел ${this.getAllData["car_brand"]}`;
        },

        filteredCarModelBySearchField() {
            if (this.search) {
                // this.setCarModel(null);
                this.search = this.search.toLowerCase();
                return this.getCarBrandWithModels.filter((model) =>
                    model.name.toLowerCase().includes(this.search)
                );
            } else {
                return this.getCarBrandWithModels;
            }
        },
    },
};
</script>

<style scoped>
a {
    display: block;
}
</style>
