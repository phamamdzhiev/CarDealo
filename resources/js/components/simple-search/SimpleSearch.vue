<template>
    <div class="base-card custom-container-lg py-4 bg-white shadow mb-5">
        <h4 class="fw-bold mb-4">
            <i class="fa-solid fa-magnifying-glass pe-2"></i>
            {{ heading }}
        </h4>
        <div class="d-grid" id="simple_search">
            <FormKit
                v-if="vehicleTypes.length > 0"
                v-model="searchQuery.type"
                type="select"
                name="type"
                :options="vehicleTypes"
                @input="handleVehicleBrands"
            />
            <FormKit
                v-if="brands.length > 0"
                v-model="searchQuery.brand"
                type="select"
                name="brand"
                placeholder="Изберете марка"
                :options="brands"
                @input="handleVehicleModels"
            />
            <FormKit
                v-if="models.length > 0"
                v-model="searchQuery.model"
                type="select"
                name="models"
                placeholder="Изберете модел"
                :options="models"
            />
            <FormKit
                v-else
                disabled
                type="select"
                name="models"
                placeholder="Изберете модел"
                :options="['Модели']"
            />
            <FormKit
                type="select"
                v-model="searchQuery.yearMin"
                placeholder="Година на регистрация след"
                :options="years"
            />
            <FormKit
                v-if="transmissions.length > 0"
                type="select"
                v-model="searchQuery.transmission"
                name="transmission"
                placeholder="Изберете трансмисия"
                :options="transmissions"
            />
            <FormKit
                v-if="fuels.length > 0"
                v-model="searchQuery.fuel"
                type="select"
                name="fuel"
                placeholder="Изберете гориво"
                :options="fuels"
            />
            <router-link style="justify-self: flex-start" class="d-inline align-self-center fw-bold text-link-blue"
                         :to="{name: 'advanced.search'}">
                Подробно търсене
            </router-link>
            <button class="base-button mt-0" @click="handleSimpleSearch">
                <i class="fa-solid fa-magnifying-glass pe-1"></i>
                Търси
            </button>
        </div>
    </div>
</template>

<script>
import {useFetcher} from "../../composables/fetcher";
import {years} from "../../helpers/years";
import {reactive, ref} from "vue";
import {useRouter} from "vue-router";

export default {
    name: "SimpleSearch",
    props: {
        heading: {
            type: String,
            required: false,
            default: "Търсене"
        }
    },
    setup() {
        const {fetch: vehicleTypes} = useFetcher('vehicle/fetch/vehicle-types');
        // onload fetch always data for cars by default
        const {fetch: brands} = useFetcher('vehicle/fetch/brands/1');
        const {fetch: transmissions} = useFetcher('fetch/transmissions');
        const {fetch: fuels} = useFetcher('fetch/fuels');
        const vehicleType = ref('1'); // 1 is for vehicle type Cars
        const models = ref([]);
        const router = useRouter();

        const searchQuery = reactive({
            type: '1',
            brand: null,
            model: null,
            yearMin: null,
            fuel: null,
            transmission: null
        });

        function handleVehicleBrands(typeID) {
            models.value = [];
            const {fetch} = useFetcher(`vehicle/fetch/brands/${typeID}`);
            brands.value = fetch.value
            vehicleType.value = typeID;
        }

        function handleVehicleModels(brandID) {
            const {fetch} = useFetcher(`vehicle/fetch/vehicle/${brandID}/category/${vehicleType.value}`);
            models.value = fetch.value
        }

        async function handleSimpleSearch() {
            Object.keys(searchQuery).forEach(key => {
                if (searchQuery[key] === null) {
                    delete searchQuery[key];
                }
            });

            await router.push({name: 'advanced.search', query: searchQuery});
        }

        return {
            vehicleTypes,
            brands,
            models,
            handleVehicleBrands,
            handleVehicleModels,
            transmissions,
            handleSimpleSearch,
            fuels,
            years,
            searchQuery: searchQuery
        }
    }

}
</script>
<style scoped>
.base-card {
    margin-top: -2.275rem;
    position: relative;
    z-index: 5000;
}

.base-button {
    grid-column: 3;
}

#simple_search {
    grid-template-columns: repeat(3, 1fr);
    gap: 15px
}
</style>
