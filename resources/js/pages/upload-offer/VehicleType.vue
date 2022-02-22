<template>
    <div class="sell-car">
        <BaseCard>
            <div class="question-section mb-4">
                <Heading :title="'Вид на превозното средство?'"/>
                <ul class="options-list">
                    <li
                        v-for="item in vehicleTypes"
                        :key="item.id"
                        :class="['item position-relative', {active: getVehicleType === item.id}]"
                        @click="setVehicleType(item.id)">
                        <span
                            v-show="getVehicleType === item.id"
                            @click.stop="store.commit('uploadOffer/setVehicleType', null)"
                            class="position-absolute top-0 start-100 translate-middle fw-bold">
                                <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                            </span>
                        {{ item.name }}
                    </li>
                </ul>
            </div>
            <NextStepButton v-if="getVehicleType" />
        </BaseCard>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import Heading from "./partials/Heading";
import NextStepButton from "./partials/NextStepButton";
import {computed, onBeforeUnmount, onMounted, ref} from "vue";
import {useStore} from "vuex";

export default {
    name: "VehicleType",
    components: {
        BaseCard,
        Heading,
        NextStepButton,
    },
    setup() {
        const store = useStore();

        let vehicleTypes = ref([
            {id: 1, name: 'Автомобили'},
            {id: 2, name: 'Мотори'},
            {id: 3, name: 'Бусове'},
            {id: 4, name: 'Камиони'},
            {id: 5, name: 'Лодки'},
            {id: 6, name: 'Селскотопански'},
            {id: 7, name: 'Индустриални'},
            {id: 8, name: 'Каравени'},
        ]);

        let isLoading = ref(false);

        function setVehicleType(typeID) {
            store.commit('uploadOffer/setVehicleType', typeID);
        }

        const getVehicleType = computed(() => {
            return store.getters['uploadOffer/getVehicleType'];
        });


        //hooks
        // onMounted(() => {
        //     store.registerModule('vehicle', vehicleModule, {preserveState: true});
        // });
        //
        // onBeforeUnmount(() => {
        //     store.unregisterModule('vehicle')
        // })


        return {
            getVehicleType,
            setVehicleType,
            isLoading,
            vehicleTypes,
            store
        }
    }
}
</script>
