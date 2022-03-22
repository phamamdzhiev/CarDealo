<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Марка</h6>
        <spinner v-if="brands.length < 1"/>
        <FormKit
            v-else
            type="select"
            :options="brands"
            placeholder="Изберете марка"
            @input="handleBrands"
            :value="route.query.brand ? route.query.brand : null"
        />
        <div class="d-flex justify-content-end align-items-center flex-nowrap">
            <button class="btn btn-reset-filter">
                <i class="fa-solid fa-xmark pe-1"></i>
                Премахни филтър
            </button>
        </div>
    </div>
    <div class="advanced-single-filter" v-if="models.length > 0">
        <h6 class="fw-bold">Модел</h6>
        <FormKit
            type="select"
            :options="models"
            @input="handleModel"
            placeholder="Изберете модел"
            :value="route.query.model ? route.query.model : null"
        />
        <div class="d-flex justify-content-end align-items-center flex-nowrap">
            <button class="btn btn-reset-filter">
                <i class="fa-solid fa-xmark pe-1"></i>
                Премахни филтър
            </button>
        </div>
    </div>
</template>

<script>
import CustomCheckbox from "../../../components/ui/CustomCheckbox";
import {useRoute, useRouter} from "vue-router";
import {useFetcher} from "../../../composables/fetcher";
import {ref, computed, watch} from 'vue';

export default {
    name: "BrandFilter",
    components: {CustomCheckbox},
    emits: ['updateQueryParams'],
    props: {
        typeID: {
            type: String,
            required: true
        }
    },
    setup(props, {emit}) {
        const router = useRouter();
        const route = useRoute();
        const models = ref([]);

        const brands = computed(() => {
            const {fetch} = useFetcher(`vehicle/fetch/brands/${props.typeID}`);
            return fetch.value;
        });

        function fetchModels(brandID) {
            const {fetch} = useFetcher(`vehicle/fetch/vehicle/${brandID}/category/1`);
            models.value = fetch.value;
        }

        watch(() => props.typeID, () => {
            models.value = [];
        });

        async function handleModel(modelID) {
            await router.push({
                name: route.name,
                query: {...route.query, model: modelID}
            });
        }

        async function handleBrands(brandID) {
            fetchModels(brandID)

            await router.push({
                name: route.name,
                query: {...route.query, brand: brandID}
            });

            emit('updateQueryParams');
        }

        return {
            handleBrands,
            handleModel,
            route,
            brands,
            models
        }
    }
}
</script>

