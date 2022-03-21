<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Област</h6>
        <spinner v-if="regions.length < 1"/>
        <FormKit
            v-else
            type="select"
            id="regions"
            name="regions"
            placeholder="Моля изберете Област"
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
import {useFetcher} from "../../../composables/fetcher";

export default {
    name: "RegionFilter",
    emits: ['updateQueryParams'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();
        const {fetch} = useFetcher('fetch/regions');

        async function handleRegions(regionID) {
            await router.push({
                name: route.name,
                query: {...route.query, region: regionID}
            });

            emit('updateQueryParams');
        }

        return {
            handleRegions,
            route,
            regions: fetch
        }
    }
}
</script>
