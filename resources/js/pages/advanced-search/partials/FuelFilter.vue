<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Гориво</h6>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="fuel" value="Бензин" @change="handleFuel" v-model="carFuel"/>
                <CustomCheckbox :checked-elements="carFuel" checked-value="Бензин"></CustomCheckbox>
                <span>Бензин</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="fuel" value="Дизел" @change="handleFuel" v-model="carFuel"/>
                <CustomCheckbox :checked-elements="carFuel" checked-value="Дизел"></CustomCheckbox>
                <span>Дизел</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="fuel" value="Хибрид" @change="handleFuel" v-model="carFuel"/>
                <CustomCheckbox :checked-elements="carFuel" checked-value="Хибрид"></CustomCheckbox>
                <span>Хибрид</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="fuel" value="Електричеки" @change="handleFuel" v-model="carFuel"/>
                <CustomCheckbox :checked-elements="carFuel" checked-value="Електричеки"></CustomCheckbox>
                <span>Електричеки</span>
            </label>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {isUndefined} from "lodash";
import CustomCheckbox from "../../../components/ui/CustomCheckbox";

export default {
    name: "YearFilter",
    components: {CustomCheckbox},
    setup() {
        const router = useRouter();
        const route = useRoute();
        let carFuel = ref([]);


        if (!isUndefined(route.query.fuel)) {
            carFuel.value = route.query.fuel.split('-');
        }

        console.log(route.query.fuel)

        function handleFuel() {
            router.push({
                name: route.name,
                query: {...route.query, fuel: carFuel.value.join('-')}
            });
        }

        return {
            carFuel,
            handleFuel
        }
    }
}
</script>
<style scoped>
label {
    font-weight: bold;
}
</style>
