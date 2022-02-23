<template>
    <div class="sell-car">
        <BaseCard>
            {{ $store.getters['carOffer/getState'] }}
            <div class="question-section mb-4">
                <Heading title="Вид на превозното средство?"/>
                <ul class="options-list">
                    <li
                        v-for="item in vehicleTypes"
                        :key="item.id"
                        :class="['item position-relative', {active: typeID === item.id}]"
                        @click="setVehicleType(item.id)">
                        <span
                            v-show="typeID === item.id"
                            @click.stop="typeID = null"
                            class="position-absolute top-0 start-100 translate-middle fw-bold">
                                <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                            </span>
                        {{ item.name }}
                    </li>
                </ul>
            </div>
            <button class="base-button" v-show="typeID !== null" @click="go">Следваща стъпка</button>
        </BaseCard>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import Heading from "./partials/Heading";
import NextStepButton from "./partials/NextStepButton";
import {onBeforeUnmount, onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import {useStore} from "vuex";

export default {
    name: "VehicleType",
    components: {
        BaseCard,
        Heading,
        NextStepButton,
    },
    setup() {
        const router = useRouter();
        const store = useStore();

        let typeID = ref(null);

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

        function go() {
            if (typeID.value === null) return;
            router.push({name: 'upload.vehicle', params: {vehicleID: typeID.value}});
        }

        function setVehicleType(t) {
            store.commit('uploadOffer/resetState');
            typeID.value = t;
        }

        //hooks
        // onMounted(() => {
        //     store.registerModule('vehicle', vehicleModule, {preserveState: true});
        // });
        //
        // onBeforeUnmount(() => {
        //     store.unregisterModule('vehicle')
        // })


        return {
            typeID,
            setVehicleType,
            isLoading,
            vehicleTypes,
            go
        }
    }
}
</script>
