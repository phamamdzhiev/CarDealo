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
            await router.push({name: 'advanced.search'});
        }

        return {
            handleSearch
        }
    }
}
</script>
