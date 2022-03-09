<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Област</h6>
        <spinner v-if="regions.length < 1"/>
        <FormKit
            v-else
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
    props: {
        regions: {
            type: Array,
            required: true
        }
    },
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();

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
            route
        }
    }
}
</script>

<style scoped>

</style>
