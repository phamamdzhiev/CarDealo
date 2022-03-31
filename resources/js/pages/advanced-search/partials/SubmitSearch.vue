<template>
    <FormKit type="button" label="Търси" @click="handleSearch"/>
</template>

<script>
import {useRouter} from "vue-router";

export default {
    name: "SubmitSearch",
    setup() {
        const router = useRouter();

        async function handleSearch() {
            await router.push({name: 'offers.showcase'});
        }

        // async function handleSimpleSearch() {
        //     let data = Object.fromEntries(Object.entries(searchQuery).filter(([k, v]) => v !== null))
        //     await router.push({name: 'offers.showcase', query: data});
        // }

        return {
            handleSearch
        }
    }
}
</script>
