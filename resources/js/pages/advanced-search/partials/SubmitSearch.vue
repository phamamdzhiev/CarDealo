<template>
    <FormKit type="button" label="Търси" @click="handleSearch"/>
</template>

<script>
import {useRouter} from "vue-router";
import {computed, ref} from "vue";
import {useStore} from "vuex";

export default {
    name: "SubmitSearch",
    setup() {
        const router = useRouter();
        const store = useStore();

        const fulfilledFilters = computed(() => {
            return store.getters['advancedFilters/fulfilledFilters'];
        })

        function handleSearch() {
            router.push({name: 'offers.showcase', query: fulfilledFilters.value})
                .catch(e => console.log(e));
        }

        return {
            handleSearch
        }
    }
}
</script>
