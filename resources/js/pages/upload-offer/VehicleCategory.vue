<template>
    <div class="sell-car">
        <BaseCard>
            <div class="question-section mb-4">
                <Heading title="Вид на превозното средство?"/>
                <spinner v-if="vehicleCategories.length < 1"/>
                <ul v-else class="options-list">
                    <li
                        v-for="vehicle in vehicleCategories"
                        :key="vehicle.id"
                        :class="['item position-relative', {active: vehicle.id === getState.vehicleCategory}]"
                        @click="setState(vehicle.id)">
                        <span
                            v-show="getState.vehicleCategory === vehicle.id"
                            @click.stop="resetState"
                            class="position-absolute top-0 start-100 translate-middle fw-bold"
                        >
                            <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                        </span>
                        <span>
                            <i :class="'fa-solid fs-3 fa-' + vehicle.slug"></i>
                        </span>
                        {{ vehicle.name }}
                    </li>
                </ul>
            </div>
            <button class="base-button"
                    v-show="getState.vehicleCategory !== null"
                    @click="go"
            >
                Следваща стъпка
            </button>
        </BaseCard>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import Heading from "./partials/Heading";
import NextStepButton from "./partials/NextStepButton";
import {computed} from "vue";
import {useRouter} from "vue-router";
import {useStore} from "vuex";
import {useFetcher} from "../../composables/fetcher";

// import offerState from "../../store/upload-offer/upload-offer";

export default {
    name: "VehicleCategory",
    components: {
        BaseCard,
        Heading,
        NextStepButton,
    },
    setup() {
        const router = useRouter();
        const store = useStore();
        const {fetch: vehicleCategories} = useFetcher('get.categories', null, false);

        const getState = computed(() => {
            return store.getters['uploadOffer/getVehicleState'];
        });

        function go() {
            if (getState.value.vehicleCategory === null) return;
            router.push({name: 'upload.vehicle', params: {vehicleID: getState.value.vehicleCategory}});
        }

        function resetState() {
            store.commit('uploadOffer/resetVehicleState');
        }

        function setState(data) {
            // store.commit('uploadOffer/resetState');
            store.commit('uploadOffer/setVehicleState', {key: 'vehicleCategory', value: data});
        }

        return {
            vehicleCategories,
            go,
            getState,
            setState,
            resetState
        }
    }
}
</script>
