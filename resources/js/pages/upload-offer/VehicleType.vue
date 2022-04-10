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
                        v-for="item in vehicleTypes"
                        :key="item.id"
                        :class="['item position-relative', {active: getVehicleType === item.id}]"
                        @click="store.commit('uploadOffer/setVehicleState', {key: 'vehicleType', value: parseInt(item.id)});">
                        <span
                            v-show="getVehicleType === item.id"
                            @click.stop="store.commit('uploadOffer/setVehicleState', {key: 'vehicleType', value: null})"
                            class="position-absolute top-0 start-100 translate-middle">
                                <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                            </span>
                        {{ item.name }}
                    </li>
                </ul>
            </div>
            <NextStepButton v-if="getVehicleType"/>
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
    name: "VehicleType",
    components: {
        BaseCard,
        Heading,
        NextStepButton,
        PrevStepButton
    },
    setup() {
        const store = useStore();
        const route = useRoute();

        const vehicleTypes = ref([]);

        let isLoading = ref(false);

        const getVehicleType = computed(() => {
            return store.getters['uploadOffer/getVehicleState'].vehicleType;
        });

        onMounted(async () => {
            const id = route.params.vehicleID;
            try {
                isLoading.value = true;
                const res = await axios.get(`/vehicle/fetch/vehicle-type/${id}/category`);
                vehicleTypes.value = res.data;
                isLoading.value = false;

            } catch (e) {
                isLoading.value = false;
                console.log(e)
            }
        });

        return {
            getVehicleType,
            isLoading,
            vehicleTypes,
            store
        }
    }

}
</script>
