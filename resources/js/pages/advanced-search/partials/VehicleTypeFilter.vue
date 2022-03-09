<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Тип</h6>
        <spinner v-if="types.length < 1"/>
        <FormKit
            v-else
            type="radio"
            :options="types"
            @input="handleCategories"
            :value="route.query.type ? route.query.type : null"
        />
    </div>
</template>

<script>
import {useRoute, useRouter} from "vue-router";
import {ref} from "vue";

export default {
    name: "VehicleTypeFilter",
    emits: ['updateQueryParams', 'fetchCategory'],
    props: {
        types: {
            type: Array,
            required: true
        }
    },
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();

        async function handleCategories(typeID) {
            await router.push({
                name: route.name,
                query: {...route.query, 'type': typeID}
            });

            emit('updateQueryParams');
            emit('fetchCategory', typeID);
        }

        return {
            handleCategories,
            route
        }
    }
}
</script>
