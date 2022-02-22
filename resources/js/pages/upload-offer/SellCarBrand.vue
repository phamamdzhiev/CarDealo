<template>
    <div class="sell-car">
        <base-card>
            <div @click="$store.commit('sellCar/setStepMinus')" class="back__button fw-bold mb-3">
                Назад
                <i class="fw-light">(Стъпка 1)</i>
            </div>
            <div class="question-section mb-4">
                <h5 class="fw-bold">Състояние?</h5>
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
                <h5 class="fw-bold">Каква марка е превозното средство?</h5>
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
                <div v-if="isLoading">Зареждане...</div>
                <div id="brand" v-else-if="getAllData['car_brand'] !== null">
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
                        Популярни марки
                    </h6>
                </display-car-brands>
            </div>
            <button @click="showStepTwo" class="base-button" v-if="getAllData['car_brand']">
                <span v-if="!isLoading">Следваща стъпка</span>
                <loading-dots v-else></loading-dots>
            </button>
        </base-card>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import axios from "axios";
import DisplayCarBrands from "./partials/DisplayCarBrands";
import BaseCard from "../../components/ui/base/BaseCard";

export default {
    name: "SellCarBrand",
    components: {
        DisplayCarBrands,
        BaseCard
    },
    data() {
        return {
            keyword: null,
            filterCarBrands: []
        }
    },
    computed: {
        ...mapGetters('sellCar', [
            'getAllData',
            'getCarPopularBrands',
            'isLoading',
            'getSelectedCarBrandID',
        ])
    },
    watch: {
        keyword() {
            this.livesearchCarBrands()
        }
    },
    async mounted() {
        await this.$store.dispatch('sellCar/setCarPopularBrands');
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
            this.$store.commit('sellCar/resetState');
        },
        selectBrand({brandName, brandID}) {
            if (this.getAllData['car_brand'] !== brandName) {
                this.resetPreSelectedCarOptions()
            }

            this.setSelectedCarBrandID(brandID);
            this.setCarBrand(brandName);
        },
    },
}
</script>

<style scoped>

</style>
