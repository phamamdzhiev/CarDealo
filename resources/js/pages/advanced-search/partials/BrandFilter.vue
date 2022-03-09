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
    props: {
        brands: {
            type: Array,
            required: true
        }
    },
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();

        async function handleBrands(brandID) {
            await router.push({
                name: route.name,
                query: {...route.query, 'brand': brandID}
            });

            emit('updateQueryParams');
        }

        return {
            handleBrands,
            route
        }
    }
}
</script>

