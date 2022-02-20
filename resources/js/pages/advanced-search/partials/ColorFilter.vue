<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Цвят</h6>
        <div class="d-flex flex-wrap">
            <label>
                <input type="checkbox"
                       class="d-none"
                       name="color"
                       value="1"
                       v-model="carColor"
                       @change="handleCarColor"
                />
                <div :class="['item', {active: carColor.includes('1')}]" style="background: red"></div>
            </label>
            <label>
                <input type="checkbox"
                       class="d-none"
                       name="color"
                       value="2"
                       v-model="carColor"
                       @change="handleCarColor"
                />
                <div :class="['item', {active: carColor.includes('2')}]" style="background: gray"></div>
            </label>
            <label>
                <input type="checkbox"
                       class="d-none"
                       name="color"
                       value="3"
                       v-model="carColor"
                       @change="handleCarColor"
                />
                <div :class="['item', {active: carColor.includes('3')}]" style="background: black"></div>
            </label>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {isUndefined} from "lodash";
import BaseGrid from "../../../components/ui/base/BaseGrid";

export default {
    name: "ColorFilter",
    setup() {
        const router = useRouter();
        const route = useRoute();
        let carColor = ref([]);

        if (!isUndefined(route.query['color[]'])) {
            carColor.value.push(...route.query['color[]']) ;
        }

        function handleCarColor() {
            router.push({
                name: route.name,
                query: {...route.query, "color[]": carColor.value}
            });
        }

        return {
            carColor,
            handleCarColor
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
