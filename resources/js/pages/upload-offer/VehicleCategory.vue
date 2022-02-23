<template>
    <div class="sell-car">
        <BaseCard>
            <router-link class="back__button mb-2 d-block" :to="{name: 'upload'}">
                <span class="fw-light">
                    <i class="bi bi-arrow-left-short"></i>
                    <i>Назад</i>
                </span>
            </router-link>
            <div class="question-section mb-4">
                <Heading title="Категория на превозното средство?"/>
                <ul class="options-list">
                    <li
                        v-for="item in vehicleCategories"
                        :key="item.id"
                        :class="['item position-relative', {active: getVehicleCategory === item.id}]"
                        @click="store.commit('uploadOffer/setState', {key: 'vehicleCategory', value: item.id});">
                        <span
                            v-show="getVehicleCategory === item.id"
                            @click.stop="store.commit('uploadOffer/setState', {key: 'vehicleCategory', value: null})"
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
import {computed, ref} from "vue";
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

        let vehicleCategories = ref([
            {id: 1, name: 'Кабрио'},
            {id: 2, name: 'Комби'},
            {id: 3, name: 'Ван'},
            {id: 4, name: 'Джип'},
            {id: 5, name: 'Хеджбек'},
            {id: 6, name: 'Седан'},
            {id: 7, name: 'Лимузина'},
            {id: 8, name: 'SUV'},
        ]);

        let isLoading = ref(false);

        const getVehicleCategory = computed(() => {
            return store.getters['uploadOffer/getState'].vehicleCategory;
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

<style scoped>

</style>
