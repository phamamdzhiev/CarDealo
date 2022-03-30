<template>
    <FormKit
        type="select"
        id="region"
        name="region"
        label="Филтрирай по регион"
        placeholder="Моля изберете регион"
        :options="regions.length > 0 ? regions : ['Филтрирай по регион']"
    />
</template>

<script>
import {useFetcher} from "../../composables/fetcher";

export default {
    name: "MerchantsFilter",
    setup() {
        const {fetch: regions} = useFetcher('get.regions')

        return {
            regions
        }
    }
}
</script>
