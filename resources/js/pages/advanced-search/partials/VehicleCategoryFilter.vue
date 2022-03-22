<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Категория </h6>
        <spinner v-if="categories.length < 1"/>
        <FormKit
            v-else
            type="radio"
            :options="categories"
            @input="handleCategories"
            :value="route.query.category ? route.query.category : null"
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
import {useRoute, useRouter} from "vue-router";
import {useFetcher} from "../../../composables/fetcher";
import {computed} from "vue";

export default {
    name: "VehicleCategoryFilter",
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

        const categories = computed(() => {
            const {fetch} = useFetcher(`vehicle/fetch/vehicle-type/${props.typeID}/category`)
            return fetch.value;
        });

        async function handleCategories(categoryID) {
            await router.push({
                name: route.name,
                query: {...route.query, category: categoryID}
            });

            emit('updateQueryParams');
        }

        return {
            handleCategories,
            categories,
            route
        }
    }
}
</script>
<style>
.btn-reset-filter {
    padding: 2px 6px;
    margin: 0;
    border: 2px solid #0D1C39;
    color: #0D1C39;
    background-color: white;
    font-weight: bold;
    font-size: 12px;
    display: flex;
    align-items: center;
}

.btn-reset-filter:hover {
    background-color: #0D1C39;
    color: white;
}
</style>
