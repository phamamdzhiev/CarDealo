<template>
    <div v-if="regions.length > 0">
        <FormKit
            type="select"
            id="color"
            name="color"
            label="Филтрирай по област"
            placeholder="Моля изберете Област"
            :options="regions"
        />
    </div>
</template>

<script>
import {useFetcher} from "../../composables/fetcher";

export default {
    name: "MerchantsFilter",
    setup() {
        const {fetch} = useFetcher('fetch/regions')

        return {
            regions: fetch
        }
    }


}
</script>
