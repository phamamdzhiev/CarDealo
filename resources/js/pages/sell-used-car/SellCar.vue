<template>
    <div>
        <div class="sell-car" v-if="getStep === 1">
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
                        <li :class="{ active: getAllData['new_or_used'] === 3 }"
                            @click="setNewOrUsed(3)">На части
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
                            autocomplete="off"
                            v-model.trim="keyword"
                        />
                    </div>
                    <div id="brand" v-if="getAllData['car_brand'] !== null">
                        <div class="item active position-relative">
                            <span
                                @click="resetFilters"
                                class="position-absolute top-0 start-100 translate-middle fw-bold">
                                <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                            </span>
                            {{ getAllData['car_brand'] }}
                        </div>
                    </div>
                    <display-car-brands
                        v-else
                        :car-brands="filterCarBrands.length === 0 ? getCarPopularBrands : filterCarBrands"
                        @setCarBrandEmit="selectBrand">
                        <h6 v-show="filterCarBrands.length === 0">
                            <i class="bi bi-star-fill text-base-color"></i>
                            Популярни марки автомобили
                        </h6>
                    </display-car-brands>
                </div>
                <button @click="showStepTwo" class="base-button" v-if="getAllData['car_brand']">
                    <span v-if="!isLoading">Следваща стъпка</span>
                    <loading-dots v-else></loading-dots>
                </button>
            </base-card>
        </div>
        <SellCarModel v-if="getStep === 2"></SellCarModel>
        <SellCarYear v-if="getStep === 3"></SellCarYear>
        <SellCarVariant v-if="getStep === 4"></SellCarVariant>
        <SellCarExtras v-if="getStep === 5"></SellCarExtras>
        <OwnerDetails v-if="getStep === 6"></OwnerDetails>
        <SellCarImages v-if="getStep === 7"></SellCarImages>
        <SellCarFinal v-if="getStep === 8"></SellCarFinal>
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
import DisplayCarBrands from "./partials/DisplayCarBrands";
import SellCarFinal from "./SellCarFinal";
import {mapActions, mapGetters, mapMutations} from "vuex";
import axios from "axios";

export default {
    name: "SellCar",
    components: {
        BaseCard,
        SellCarModel,
        SellCarYear,
        SellCarVariant,
        SellCarExtras,
        SellCarImages,
        OwnerDetails,
        SellCarFinal,
        DisplayCarBrands
    },
    data() {
        return {
            keyword: null,
            filterCarBrands: []
        }
    },
    watch: {
        keyword() {
            this.livesearchCarBrands()
        }
    },
    computed: {
        ...mapGetters('sellCar', [
            'getAllData',
            'getCarPopularBrands',
            'getStep',
            'isLoading',
            'getSelectedCarBrandID',
        ])
    },
    methods: {
        resetFilters() {
            this.setCarBrand(null);
            this.filterCarBrands = []
        },
        ...mapMutations('sellCar', [
                'setNewOrUsed',
                'setPopularCarBrands',
                'setSelectedCarBrandID',
                'setCarBrand',
                'setStepPlus',
                'setCarYear',
                'setCarModel',
                'setCarFuel',
                'setCarTransmission',
                'setCarKm',
                'setCarCm3',
                'setCarHp',
                'setStepToOne',
                'setCarExtras'
            ]
        ),
        ...mapActions('sellCar', ['setCarBrandWithModels']),

        async livesearchCarBrands() {
            if (this.keyword.length <= 1) {
                this.filterCarBrands = [];
                return;
            }

            this.setCarBrand(null);
            try {
                const res = await axios.get('vehicle/search/brands', {params: {keyword: this.keyword}});
                this.filterCarBrands = res.data;
            } catch (e) {
                console.log('Live Search Error', e);
            }
        },

        async showStepTwo() {
            if (!this.getAllData['car_brand']) {
                return
            }

            await this.setCarBrandWithModels(this.getSelectedCarBrandID);
            this.setStepPlus();
        },
        resetPreSelectedCarOptions() {
            this.setCarModel(null);
            this.setCarYear(null);
            this.setCarFuel(null);
            this.setCarTransmission(null);
            this.setCarCm3(null);
            this.setCarHp(null);
            this.setCarKm(null);
            this.setCarExtras(null);
        },
        selectBrand({brandName, brandID}) {
            if (this.getAllData['car_brand'] !== brandName) {
                this.resetPreSelectedCarOptions()
            }

            this.setSelectedCarBrandID(brandID);
            this.setCarBrand(brandName);
        },
    },
    async created() {
        //set all brands and extras from API
        await this.$store.dispatch('sellCar/setCarPopularBrands');
        await this.$store.dispatch('sellCar/setCarExtrasApi');
    },
    beforeRouteLeave(to, from, next) {
        if (this.getAllData['car_brand']) {
            if (!window.confirm("Ако напуснете тази страница сега, възможно е да загубите информацията, която сте въвели!")) {
                return;
            }
        }
        this.setStepToOne();
        next();
    },
}
</script>
