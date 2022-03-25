<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <div class="question-section mb-4">
                <Heading title="Състояние?"/>
                <ul id="new__or__used">
                    <li :class="{ active: getState.condition === 1}"
                        @click="setState({key: 'condition', value: 1})"
                    >
                        Употребяван
                    </li>
                    <li :class="{ active: getState.condition === 2 }"
                        @click="setState({key: 'condition', value: 2})"
                    >
                        Нов
                    </li>
                    <li :class="{ active: getState.condition === 3 }"
                        @click="setState({key: 'condition', value: 3})"
                    >
                        На части
                    </li>
                </ul>
            </div>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Каква марка е превозното средство?</h5>
                <div class="form-group" style="max-width: 250px;">
                    <FormKit
                        type="search"
                        placeholder="Търси марка"
                        id="search__brand"
                        autocomplete="off"
                        :delay="400"
                        @input="handleSearchBrands"
                    />
                </div>
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
                    <spinner v-if="isLoading"/>
                    <div id="brand" v-else>
                        <template v-if="searchBrands">
                            <div v-show="searchBrands.length === 0">Няма данни</div>
                            <div v-for="brand in searchBrands " :key="brand.id" class="item"
                                 @click="setState({key:'brand', value: {name: brand.name, id: brand.id}})">
                                {{ brand.name }}
                            </div>
                        </template>
                        <template v-else>
                            <div v-for="brand in popularBrands " :key="brand.id" class="item"
                                 @click="setState({key:'brand', value: {name: brand.name, id: brand.id}})">
                                {{ brand.name }}
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <next-step-button v-if="getState.brand.id">
                Следваща стъпка
            </next-step-button>
        </base-card>
    </div>
</template>

<script>
import axios from "axios";
import BaseCard from "../../components/ui/base/BaseCard";
import Heading from "./partials/Heading";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import {useRoute} from "vue-router";
import PrevStepButton from "./partials/PrevStepButton";
import NextStepButton from "./partials/NextStepButton";
import {axiosFetcher} from "../../helpers/axiosFetcher";

export default {
    name: "SellCarBrand",
    components: {
        Heading,
        BaseCard,
        PrevStepButton,
        NextStepButton
    },
    setup() {
        const store = useStore();
        const route = useRoute();
        const searchBrands = ref(null);
        const {isLoading, data: popularBrands} = axiosFetcher(`vehicle/fetch/brands/${route.params.vehicleID}/1`)

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        function setState(payload) {
            store.commit('uploadOffer/setVehicleState', payload);
        }

        async function handleSearchBrands(e) {
            if (e.length < 2) {
                searchBrands.value = null;
            } else {
                try {
                    const res = await axios.get(`vehicle/fetch/search/brands/${route.params.vehicleID}`, {params: {keyword: e}});
                    if (res.data) {
                        searchBrands.value = res.data;
                    }
                } catch (e) {
                    console.log('Live Search Error', e);
                }
            }
        }

        return {
            setState,
            getState,
            popularBrands,
            searchBrands,
            isLoading,
            handleSearchBrands
        }
    }
}
</script>
