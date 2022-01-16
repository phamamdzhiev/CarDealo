<template>
    <div>
        <div class="sell-car" v-show="getStep === 0">
            <base-card>
                <div class="question-section mb-4">
                    <h5 class="fw-bold">Състояние на автомобила?</h5>
                    <ul id="new__or__used">
                        <li :class="{ active: dataStepOne.oldOrNew === 'Употребяван'}"
                            @click="dataStepOne.oldOrNew = 'Употребяван'">Употребяван
                        </li>
                        <li :class="{ active: dataStepOne.oldOrNew === 'Нов' }"
                            @click="dataStepOne.oldOrNew = 'Нов'">Нов
                        </li>
                    </ul>
                </div>
                <div class="question-section mb-3">
                    <h5 class="fw-bold">Каква марка е автомобила?</h5>
                    <div class="form-group">
                        <input
                            type="text"
                            id="search__brand"
                            class="form__input"
                            placeholder="Търси марка"
                            v-model.trim="search"
                        />
                    </div>
                    <div id="brand" v-if="getCarBrands">
                        <div v-for="(brand, index) in filteredCarBrand" :key="brand.id"
                             class="item"
                             :class="{ active: index === current }"
                             @click="selectBrand(brand.name, brand.id, index)">
                            {{ brand.name }}
                        </div>
                    </div>
                    <div class="text-center mt-3" v-else>Зареждане...</div>
                </div>
                <button @click="showStepTwo" class="base-button" v-show="dataStepOne.selectedBrand">
                    <span v-if="!isLoading">Следваща стъпка</span>
                    <loading-dots v-else></loading-dots>
                </button>
            </base-card>
        </div>
        <SellCarModel v-show="getStep === 2"></SellCarModel>
        <SellCarYear v-show="getStep === 3"></SellCarYear>
        <SellCarVariant v-show="getStep === 4"></SellCarVariant>
        <SellCarExtras v-show="getStep === 5"></SellCarExtras>
        <OwnerDetails v-show="getStep === 6"></OwnerDetails>
        <SellCarImages v-show="getStep === 1"></SellCarImages>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import SellCarYear from "./SellCarYear";
import SellCarModel from "./SellCarModel";
import SellCarVariant from "./SellCarVariant";
import SellCarExtras from "./SellCarExtras";
import SellCarImages from "./SellCarImages";
import OwnerDetails from "./OwnerDetails";

export default {
    name: "SellCar",
    components: {
        BaseCard,
        SellCarModel,
        SellCarYear,
        SellCarVariant,
        SellCarExtras,
        SellCarImages,
        OwnerDetails
    },
    data() {
        return {
            current: null,
            search: null,
            selectedBrandID: null,
            dataStepOne: {
                selectedBrand: null,
                oldOrNew: 'Употребяван'
            },
        }
    },
    computed: {
        //get all brands
        getCarBrands() {
            return this.$store.getters['sellCar/getCarBrands'];
        },
        getStep() {
            return this.$store.getters['sellCar/getStep'];
        },
        isLoading() {
            return this.$store.getters['sellCar/isLoading'];
        },
        filteredCarBrand() {
            if (this.search) {
                this.current = null;
                this.dataStepOne.selectedBrand = null;
                this.search = this.search.toLowerCase();
                return this.getCarBrands.filter((model) =>
                    model.name.toLowerCase().includes(this.search)
                );
            } else {
                return this.getCarBrands;
            }
        },
    },
    methods: {
        async showStepTwo() {
            if (!this.dataStepOne.selectedBrand) {
                return
            }
            //send data to Vuex
            this.$store.commit('sellCar/setNewOrUsed', this.dataStepOne.oldOrNew);
            this.$store.commit('sellCar/setCarMake', this.dataStepOne.selectedBrand);
            await this.$store.dispatch('sellCar/setCarBrandWithModels', this.selectedBrandID);
            this.$store.commit('sellCar/setStepPlus');
        },
        selectBrand(brand, brandID, index) {
            this.current = index;
            this.selectedBrandID = brandID;
            this.dataStepOne.selectedBrand = brand;
        },
    },
    created() {
        //set all brands and extras from API
        this.$store.dispatch('sellCar/setCarBrands');
        this.$store.dispatch('sellCar/setCarExtrasApi');
    },

    beforeRouteLeave(to, from, next) {
        if (this.dataStepOne.selectedBrand) {
            if (!window.confirm("Сигурен ли си?")) {
                return;
            }
        }
        this.$store.commit('sellCar/setStepToOne');
        next();
    },
}
</script>
