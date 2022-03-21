<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Цвят</h6>
        <spinner v-if="colors.length < 1"/>
        <FormKit
            v-else
            type="select"
            id="color"
            name="color"
            :value="route.query.color ? route.query.color : null"
            placeholder="Моля изберете Цвят"
            :options="colors"
            @input="handleCarColor"
        />
    </div>
</template>

<script>
import {useRoute, useRouter} from "vue-router";
import {useFetcher} from "../../../composables/fetcher";

export default {
    name: "ColorFilter",
    emits: ['updateQueryParams'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();
        const {fetch} = useFetcher('fetch/colors');

        function handleCarColor(colorValue) {
            router.push({
                name: route.name,
                query: {...route.query, color: colorValue}
            });
            emit('updateQueryParams');
        }

        return {
            route,
            colors: fetch,
            handleCarColor,
        }
    }
}
</script>
<style scoped>
label {
    height: 38px;
    width: 38px;
    margin-right: 10px;
    border-radius: 12px;
}

.item {
    width: 100%;
    height: 100%;
    border-radius: 12px;
}

.item.active {
    outline: 2px solid black;
    outline-offset: 3px;
}

</style>
