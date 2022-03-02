<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Област</h6>
        <FormKit
            type="radio"
            :options="regions"
            @input="handleRegions"
            :value="route.query.region ? route.query.region : null"
        />
    </div>
</template>

<script>
import {useRoute, useRouter} from "vue-router";
import {ref} from "vue";
import {isUndefined} from "lodash";

export default {
    name: "RegionFilter",
    emits: ['updateQueryParams'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();

        const regions = ref([
            {value: 1, label: 'Пловдив'},
            {value: 2, label: 'София'},
            {value: 3, label: 'Варна'},
            {value: 4, label: 'Велико търново'},
        ]);
        //
        // if (!isUndefined(route.query['region'])) {
        //
        // }

        async function handleRegions(regionID) {
            await router.push({
                name: route.name,
                query: {...route.query, 'region': regionID}
            });

            emit('updateQueryParams');
        }

        return {
            handleRegions,
            regions,
            route
        }
    }
}
</script>

<style scoped>

</style>
