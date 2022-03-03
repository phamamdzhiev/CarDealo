<template>
    <div class="sell-car">
        <BaseCard>
            <div class="question-section mb-4">
                <Heading title="Вид на превозното средство?"/>
                <spinner v-if="isLoading"/>
                <ul v-else class="options-list">
                    <li
                        v-for="item in vehicleCategories"
                        :key="item.id"
                        :class="['item position-relative', {active: item.id === getState.vehicleCategory}]"
                        @click="setState(item.id)">
                        <span
                            v-show="getState.vehicleCategory === item.id"
                            @click.stop="resetState"
                            class="position-absolute top-0 start-100 translate-middle fw-bold">
                                <i class="bi bi-x-circle-fill fs-6 bg-white"></i>
                            </span>
                        <span>
                            <i :class="'fa-solid fs-3 fa-' + item.slug"></i>
                        </span>
                        {{ item.name }}
                    </li>
                </ul>
            </div>
            <button class="base-button" v-show="getState.vehicleCategory !== null" @click="go">Следваща стъпк </button>
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
import axios from "axios";

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
        const vehicleCategories = ref([]);
        const isLoading = ref(false);

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

        //hooks
        onMounted(async () => {
            // store.registerModule('ooo', offerState, {preserveState: true});

            try {
                isLoading.value = true;
                const res = await axios.get('/vehicle/fetch/vehicle-types');
                vehicleCategories.value = res.data;
                isLoading.value = false;

            } catch (e) {
                isLoading.value = false;
                console.log(e)
            }
        });

        return {
            isLoading,
            vehicleCategories,
            go,
            getState,
            setState,
            resetState
        }
    }
}
</script>
