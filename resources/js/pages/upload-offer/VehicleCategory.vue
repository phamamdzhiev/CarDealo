<template>
    <div class="sell-car">
        <BaseCard>
            <router-link class="back__button mb-2 d-inline-block" :to="{name: 'upload'}">
                <span class="fw-light">
                    <i class="bi bi-arrow-left-short"></i>
                    <span>Назад</span>
                </span>
            </router-link>
            <div class="question-section mb-4">
                <Heading title="Категория на превозното средство?"/>
                <spinner v-if="isLoading"/>
                <ul class="options-list" v-else>
                    <li
                        v-for="item in vehicleCategories"
                        :key="item.id"
                        :class="['item position-relative', {active: getVehicleCategory === item.id}]"
                        @click="store.commit('uploadOffer/setVehicleState', {key: 'vehicleCategory', value: item.id});">
                        <span
                            v-show="getVehicleCategory === item.id"
                            @click.stop="store.commit('uploadOffer/setVehicleState', {key: 'vehicleCategory', value: null})"
                            class="position-absolute top-0 start-100 translate-middle fw-bold">
                                <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                            </span>
                        {{ item.name }}
                    </li>
                </ul>
            </div>
            <NextStepButton v-if="getVehicleCategory"/>
        </BaseCard>
    </div>
</template>

<script>
import Heading from "./partials/Heading";
import BaseCard from "../../components/ui/base/BaseCard";
import NextStepButton from "./partials/NextStepButton";
import PrevStepButton from "./partials/PrevStepButton"
import {useStore} from "vuex";
import {computed, onMounted, ref} from "vue";
import axios from "axios";
import {useRoute} from "vue-router";
export default {
    name: "VehicleCategory",
    components: {
        BaseCard,
        Heading,
        NextStepButton,
        PrevStepButton
    },
    setup() {
        const store = useStore();
        const route = useRoute();

        const vehicleCategories = ref([]);

        let isLoading = ref(false);

        const getVehicleCategory = computed(() => {
            return store.getters['uploadOffer/getVehicleState'].vehicleCategory;
        });

        onMounted(async () => {
            const id = route.params.vehicleID;
            try {
                isLoading.value = true;
                const res = await axios.get(`/vehicle/fetch/vehicle-type/${id}/category`);
                vehicleCategories.value = res.data;
                isLoading.value = false;

            } catch (e) {
                isLoading.value = false;
                console.log(e)
            }
        });

        return {
            getVehicleCategory,
            isLoading,
            vehicleCategories,
            store
        }
    }

}
</script>
