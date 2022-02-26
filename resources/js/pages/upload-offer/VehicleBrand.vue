<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <div class="question-section mb-4">
                <Heading title="Състояние?"/>
                <ul id="new__or__used">
                    <li :class="{ active: getState.condition === 1}"
                        @click="setState({key: 'condition', value: 1})">
                        Употребяван
                    </li>
                    <li :class="{ active: getState.condition === 2 }"
                        @click="setState({key: 'condition', value: 2})">Нов
                    </li>
                    <li :class="{ active: getState.condition === 3 }"
                        @click="setState({key: 'condition', value: 3})">На части
                    </li>
                </ul>
            </div>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Каква марка е превозното средство?</h5>
                <div class="form-group" style="max-width: 250px;">
                    <FormKit
                        type="search"
                        placeholder="Търси марка"
                        value="Apple Cider"
                        id="search__brand"
                        v-model.trim="keyword"
                        autocomplete="off"
                    />
                </div>
                <!--                <div v-if="isLoading">Зареждане...</div>-->
                <div id="brand" v-if="getState.brand.id !== null">
                    <div class="item active position-relative">
                            <span
                                @click.stop="setState({key: 'brand', value: {name: null, id: null}})"
                                class="position-absolute top-0 start-100 translate-middle fw-bold">
                                <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                            </span>
                        {{ getState.brand.name }}
                    </div>
                </div>
                <div v-else>
                    <h6 v-show="!searchBrands">
                        <i class="bi bi-star-fill text-base-color"></i>
                        Популярни марки
                    </h6>
                    <div id="brand">
                        <div v-for="brand in brandsArray" :key="brand.id" class="item"
                             @click="setState({key:'brand', value: {name: brand.name, id: brand.id}})">
                            {{ brand.name }}
                        </div>
                    </div>
                </div>
            </div>
            <button @click="showStepTwo" class="base-button" v-if="getState.brand">
                Следваща стъпка
                <!--                <span v-if="!isLoading"></span>-->
                <!--                <loading-dots v-else></loading-dots>-->
            </button>
        </base-card>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import axios from "axios";
import BaseCard from "../../components/ui/base/BaseCard";
import Heading from "./partials/Heading";
import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";
import PrevStepButton from "./partials/PrevStepButton";

export default {
    name: "SellCarBrand",
    components: {
        Heading,
        BaseCard,
        PrevStepButton
    },
    setup() {
        const store = useStore();

        let popularBrands = ref(null);

        let searchBrands = ref(null);

        let brandsArray = ref(null);

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        function showStepTwo() {
            if (getState.brand) return;
            store.commit('uploadOffer/setStepPlus');
            // await this.setCarBrandWithModels(this.getSelectedCarBrandID);
        }

        function setState(payload) {
            store.commit('uploadOffer/setVehicleState', payload);
        }

        //hooks
        onMounted(() => {
           axios.get('vehicle/fetch/popular-brands').then((res) => {
               brandsArray.value = res.data;
           })
        });

        return {
            setState,
            getState,
            brandsArray,
            searchBrands,
            showStepTwo
        }
    },
    data() {
        return {
            keyword: null,
            filterCarBrands: []
        }
    },
    computed: {

        // ...mapGetters('sellCar', [
        //     'getAllData',
        //     'getCarPopularBrands',
        //     'isLoading',
        //     'getSelectedCarBrandID',
        // ])
    },
    watch: {
        keyword() {
            this.livesearchCarBrands()
        }
    },
    async mounted() {
        // await this.$store.dispatch('sellCar/setCarPopularBrands');
    },
    methods: {
        ...mapMutations('sellCar', [
                'setPopularCarBrands',
                'setSelectedCarBrandID',
                'setCarBrand',
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


        resetPreSelectedCarOptions() {
            this.$store.commit('sellCar/resetState');
        },
        // selectBrand({brandName, brandID}) {
        //     if (this.getAllData['car_brand'] !== brandName) {
        //         this.resetPreSelectedCarOptions()
        //     }
        //
        //     this.setSelectedCarBrandID(brandID);
        //     this.setCarBrand(brandName);
        // },
    },
}
</script>

<style scoped>

</style>
