<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Категория</h6>
        <FormKit
            type="radio"
            :options="categories"
            @input="handleCategories"
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
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();

        const categories = ref([
            {value: 1, label: 'Автомобили'},
            {value: 2, label: 'Бусове'},
            {value: 3, label: 'Камиони'},
            {value: 4, label: 'Лодки'},
        ]);

        async function handleCategories(categoryID) {
            await router.push({
                name: route.name,
                query: {...route.query, 'category': categoryID}
            });

            emit('updateQueryParams');
        }

        return {
            handleCategories,
            categories,
            route
        }
    }
}
</script>
