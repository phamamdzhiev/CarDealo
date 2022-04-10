<template>
    <button id="clear-filters" @click="clearFilters">
        Изчисти филтри
    </button>
</template>

<script>
import {useStore} from "vuex";

export default {
    name: "ClearFilters",
    setup() {
        const store = useStore();

        function clearFilters() {
            store.commit('advancedFilters/resetFilter');
        }

        return {
            clearFilters
        }
    }
}
</script>

<style scoped>
button#clear-filters {
    background-color: white;
    border: 0;
    color: #0D1C39;
    margin-bottom: 10px;
    margin-left: 15px;
}
</style>
