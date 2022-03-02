<template>

</template>

<script>
import {ref} from "vue";

export default {
    name: "ModelFilter",
    setup() {
        const regions = ref([
            {id: 1, name: 'Плодвид'}
        ])
        return {
            regions
        }
    }
}
</script>

<style scoped>

</style>
