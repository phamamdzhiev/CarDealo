<template>
    <div>
        <FormKit
            v-if="regions.length > 0"
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
import {fetchRegions} from "../../composables/fetchRegionsAJAX";

export default {
    name: "MerchantsFilter",
    setup() {
        const { regions } = fetchRegions()

        return {
            regions
        }
    }


}
</script>
