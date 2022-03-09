<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Категория</h6>
        <FormKit
            type="radio"
            :options="categories"
            @input="handleTypes"
            :value="route.query.category ? route.query.category : null"
        />
    </div>
</template>

<script>
import {useRoute, useRouter} from "vue-router";
import {ref} from "vue";

export default {
    name: "VehicleCategoryFilter",
    emits: ['updateQueryParams'],
    props: {
        categories: {
            type: Array,
            required: true
        }
    },
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();

        async function handleTypes(categoryID) {
            await router.push({
                name: route.name,
                query: {...route.query, 'category': categoryID}
            });

            emit('updateQueryParams');
        }

        return {
            handleTypes,
            route
        }
    }
}
</script>

<style scoped>

</style>
