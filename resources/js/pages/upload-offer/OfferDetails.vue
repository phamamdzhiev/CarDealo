<template>
    <div class="sell-car">
        <base-card>
            <PrevStepButton/>
            <TopBar/>
            <div class="question-section mb-3">
                <Heading title="Детайли по обявата?"/>
                <FormKit
                    type="form"
                    submit-label="Следваща стъпка"
                    @submit="submitHandler"
                    incomplete-message="Моля, попълнете коректно всички задължителни полета"
                >
                    <FormKit
                        type="text"
                        id="title"
                        name="title"
                        label="Заглавие на обявата"
                        validation="required|length:10,100"
                        v-model.lazy.trim="title"
                    />
                    <FormKit
                        type="textarea"
                        id="description"
                        name="description"
                        label="Описание на обявата"
                        rows="6"
                        validation="required|length:10,5000"
                        v-model.trim.lazy="description"
                        help="до 5000 символа"
                    />
                    <FormKit
                        type="number"
                        id="price"
                        name="price"
                        label="Цена"
                        :validation="dynamicValidations"
                        v-model.lazy="price"
                        help="в лева"
                        :wrapper-class="{
                           'disabled': hasPrice,
                         }"
                    />
                    <FormKit
                        v-model="hasPrice"
                        type="checkbox"
                        name="hasPrice"
                        id="hasPrice"
                        label="По договаряне?"
                    />
                    <FormKit
                        type="select"
                        id="region"
                        name="region"
                        label="Област"
                        placeholder="Моля изберете област"
                        :options="regions.length > 0 ? regions : ['Изберете област']"
                        @change="setState($event.target)"
                        validation="required"
                    />
                    <FormKit
                        type="select"
                        label="Град"
                        id="city"
                        name="city"
                        placeholder="Моля изберете град"
                        :options="cities.length > 0 ? cities : ['Изберете град']"
                        @change="setState($event.target)"
                        validation="required"
                    />
                </FormKit>
            </div>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import BaseModal from "../../components/ui/base/BaseModal";
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import TopBar from "./TopBar";
import Heading from "./partials/Heading";
import PrevStepButton from "./partials/PrevStepButton";
import axios from "axios";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import {useFetcher} from "../../composables/fetcher";

export default {
    name: "OfferDetails",
    components: {
        Heading,
        PrevStepButton,
        TopBar,
        BaseCard,
        BaseModal,
        FromInputValidationMessage
    },
    setup() {
        const store = useStore();
        const {fetch:regions} = useFetcher('fetch/regions');
        const cities = ref([]);

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        const title = computed({
            get: () => {
                return getState.value.title;
            },
            set: (val) => {
                setState({name: 'title', value: val});
            }
        });

        const description = computed({
            get: () => {
                return getState.value.description;
            },
            set: (val) => {
                setState({name: 'description', value: val});
            }
        });

        const price = computed({
            get: () => {
                return getState.value.price;
            },
            set: (val) => {
                setState({name: 'price', value: val});
            }
        });

        const hasPrice = computed({
            get: () => {
                return getState.value.hasPrice;
            },
            set: (val) => {
                if (val) {
                    setState({name: 'price', value: null});
                }
                setState({name: 'hasPrice', value: val});
            }
        });

        function setState(e) {
            if (e.name === 'region') {
                cities.value = [];
                fetchCitiesForRegion(e.value);
            }
            store.commit('uploadOffer/setVehicleState', {key: e.name, value: e.value});
        }

        function submitHandler() {
            store.commit('uploadOffer/setStepPlus');
        }

        function fetchCitiesForRegion(regionID) {
            axios.get(`fetch/cities/${regionID}`).then((res) => {
                res.data.data.forEach((element) => {
                    cities.value.push({ label: element.name, value: element.id });
                });

            }).catch((e) => console.log(e));
        }

        const dynamicValidations = computed(() => {
            if (hasPrice.value) {
                return 'max:999999';
            } else {
                return 'required|number|max:999999|min:100';
            }
        });

        return {
            regions,
            cities,
            title,
            description,
            price,
            setState,
            submitHandler,
            hasPrice,
            dynamicValidations
        }
    }
}
</script>

<style scoped>
.sell-car {
    max-width: 800px;
}
</style>
