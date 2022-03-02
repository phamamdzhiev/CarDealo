<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Тип</h6>
        <FormKit
            type="radio"
            :options="types"
            @input="handleTypes"
            :value="route.query.type ? route.query.type : null"
        />
    </div>
</template>

<script>
import {useRoute, useRouter} from "vue-router";
import {ref} from "vue";

export default {
    name: "VehicleTypeFilter",
    emits: ['updateQueryParams'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();

        const types = ref([
            {value: 1, label: 'Комби'},
            {value: 2, label: 'Седан'},
            {value: 3, label: 'Хеджбек'},
            {value: 4, label: 'SUV'},
        ]);

        async function handleTypes(typeID) {
            await router.push({
                name: route.name,
                query: {...route.query, 'type': typeID}
            });

            emit('updateQueryParams');
        }

        return {
            handleTypes,
            types,
            route
        }
    }
}
</script>

<style scoped>

</style>
