<template>
    <div class="sell-car">
        <BaseCard>
            <div class="question-section mb-4">
                <Heading title="Вид на превозното средство?"/>
                <ul class="options-list">
                    <li
                        v-for="item in vehicleTypes"
                        :key="item.id"
                        :class="['item position-relative', {active: item.id === getState.vehicleType}]"
                        @click="setState(item.id)">
                        <span
                            v-show="getState.vehicleType === item.id"
                            @click.stop="resetState"
                            class="position-absolute top-0 start-100 translate-middle fw-bold">
                                <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                            </span>
                        {{ item.name }}
                    </li>
                </ul>
            </div>
            <button class="base-button" v-show="getState.vehicleType !== null" @click="go">Следваща стъпка</button>
        </BaseCard>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import Heading from "./partials/Heading";
import NextStepButton from "./partials/NextStepButton";
import {computed, onBeforeUnmount, onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import {useStore} from "vuex";
// import offerState from "../../store/upload-offer/upload-offer";

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


        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        function go() {
            if (getState.value.vehicleType === null) return;
            router.push({name: 'upload.vehicle', params: {vehicleID: getState.value.vehicleType}});
        }

        function resetState() {
            console.log('it will reset state, but later :)');
            // store.commit('uploadOffer/resetState');
        }

        function setState(data) {
            // store.commit('uploadOffer/resetState');
            store.commit('uploadOffer/setVehicleState', {key: 'vehicleType', value: data});
        }

        //hooks
        // onMounted(() => {
        //     console.log('mounted')
        //     store.registerModule('ooo', offerState, {preserveState: true});
        // });
        //
        // onBeforeUnmount(() => {
        //     store.unregisterModule('vehicle')
        // })


        return {
            isLoading,
            vehicleTypes,
            go,
            getState,
            setState,
            resetState
        }
    }
}
</script>
