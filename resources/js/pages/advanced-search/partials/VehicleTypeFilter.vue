<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Тип</h6>
        <spinner v-if="types.length < 1"/>
        <FormKit
            v-else
            type="radio"
            :options="types"
            @input="handleCategories"
            :value="route.query.type ? route.query.type : '1'"
        />
    </div>
</template>

<script>
import {useRoute, useRouter} from "vue-router";
import {useFetcher} from "../../../composables/fetcher";

export default {
    name: "VehicleTypeFilter",
    emits: ['updateQueryParams', 'fetchCategory'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();
        const {fetch} = useFetcher('vehicle/fetch/vehicle-types');

        async function handleCategories(typeID) {
            await router.push({
                name: route.name,
                query: {type: typeID}
            });

            emit('updateQueryParams');
            emit('fetchCategory', typeID);
        }

        return {
            handleCategories,
            types: fetch,
            route
        }
    }
}
</script>
