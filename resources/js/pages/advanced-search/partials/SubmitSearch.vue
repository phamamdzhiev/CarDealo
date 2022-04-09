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

        const queryParamFilters = computed(() => {
            return store.getters['advancedFilters/getFilters'];
        })

        async function handleSearch() {
            let data = Object.fromEntries(Object.entries(queryParamFilters.value).filter(([k, v]) => v !== ""))
            await router.push({name: 'offers.showcase', query: data});
        }

        return {
            handleSearch
        }
    }
}
</script>
