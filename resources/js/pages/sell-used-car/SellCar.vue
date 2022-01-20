<template>
    <div>
        <div class="sell-car" v-show="getStep === 1">
            <base-card>
                <div class="question-section mb-4">
                    <h5 class="fw-bold">Състояние на автомобила?</h5>
                    <ul id="new__or__used">
                        <li :class="{ active: getAllData['new_or_used'] === 1}"
                            @click="setNewOrUsed(1)">Употребяван
                        </li>
                        <li :class="{ active: getAllData['new_or_used'] === 2 }"
                            @click="setNewOrUsed(2)">Нов
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
                             :class="{ active: brand.name === getAllData['car_brand'] }"
                             @click="selectBrand(brand.name, brand.id)">
                            {{ brand.name }}
                        </div>
                    </div>
                    <div class="text-center mt-3" v-else>Зареждане...</div>
                </div>
                <button @click="showStepTwo" class="base-button" v-show="getAllData['car_brand']">
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
        <SellCarImages v-show="getStep === 7"></SellCarImages>
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
import {mapActions, mapGetters, mapMutations} from "vuex";

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
            search: null,
        }
    },
    computed: {
        ...mapGetters('sellCar', ['getAllData', 'getCarBrands', 'getStep', 'isLoading', 'getSelectedCarBrandID']),

        filteredCarBrand() {
            if (this.search) {
                this.setCarBrand(null);
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
        ...mapMutations('sellCar', ['setNewOrUsed', 'setCarBrand', 'setSelectedCarBrandID', 'setStepPlus']),
        ...mapActions('sellCar', ['setCarBrandWithModels']),

        async showStepTwo() {
            if (!this.getAllData['car_brand']) {
                return
            }

            await this.setCarBrandWithModels(this.getSelectedCarBrandID);
            this.setStepPlus();
        },
        selectBrand(brandName, brandID) {
            this.setSelectedCarBrandID(brandID);
            this.setCarBrand(brandName);
        },
    },
    created() {
        //set all brands and extras from API
        this.$store.dispatch('sellCar/setCarBrands');
        this.$store.dispatch('sellCar/setCarExtrasApi');
    },

    // beforeRouteLeave(to, from, next) {
    //     if (this.dataStepOne.selectedBrand) {
    //         if (!window.confirm("Сигурен ли си?")) {
    //             return;
    //         }
    //     }
    //     this.$store.commit('sellCar/setStepToOne');
    //     next();
    // },
}
</script>
