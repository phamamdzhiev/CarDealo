<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Марка</h6>
        <FormKit
            type="search"
            placeholder="Tърсене на марка..."
        />
        <FormKit
            type="radio"
            :options="brands"
            @input="handleBrands"
            :value="route.query.brand ? route.query.brand : null"
        />
    </div>
</template>

<script>
import {ref} from "vue";
import CustomCheckbox from "../../../components/ui/CustomCheckbox";
import {useRoute, useRouter} from "vue-router";

export default {
    name: "BrandFilter",
    components: {CustomCheckbox},
    emits: ['updateQueryParams'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();
        const brands = ref([
            {value: 1, label: 'BMW'},
            {value: 2, label: 'Audi'},
            {value: 3, label: 'Skoda'},
            {value: 3, label: 'Skoda'},
            {value: 3, label: 'Skoda'},
            {value: 3, label: 'Skoda'},
            {value: 3, label: 'Skoda'},
            {value: 3, label: 'Skoda'},
            {value: 3, label: 'Skoda'},
            {value: 3, label: 'Skoda'},
            {value: 3, label: 'Skoda'},
        ]);

        async function handleBrands(brandID) {
            await router.push({
                name: route.name,
                query: {...route.query, 'brand': brandID}
            });

            emit('updateQueryParams');
        }

        return {
            brands,
            handleBrands,
            route
        }
    }
}
</script>

