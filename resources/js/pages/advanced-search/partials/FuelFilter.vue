<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Гориво</h6>
        <spinner v-if="fuels.length < 1"/>
        <FormKit
            v-else
            type="radio"
            name="fuels"
            :options="fuels"
            :value="route.query.fuel ? route.query.fuel : null"
            @input="handleFuel"
        />

        <!--        <div class="form-group">-->
        <!--            <label>-->
        <!--                <input type="checkbox" class="d-none" name="fuel" value="1" @change="handleFuel" v-model="carFuel"/>-->
        <!--                <CustomCheckbox :checked-elements="carFuel" checked-value="1"></CustomCheckbox>-->
        <!--                <span>Бензин</span>-->
        <!--            </label>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label>-->
        <!--                <input type="checkbox" class="d-none" name="fuel" value="2" @change="handleFuel" v-model="carFuel"/>-->
        <!--                <CustomCheckbox :checked-elements="carFuel" checked-value="2"></CustomCheckbox>-->
        <!--                <span>Дизел</span>-->
        <!--            </label>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label>-->
        <!--                <input type="checkbox" class="d-none" name="fuel" value="3" @change="handleFuel" v-model="carFuel"/>-->
        <!--                <CustomCheckbox :checked-elements="carFuel" checked-value="3"></CustomCheckbox>-->
        <!--                <span>Хибрид</span>-->
        <!--            </label>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label>-->
        <!--                <input type="checkbox" class="d-none" name="fuel" value="4" @change="handleFuel" v-model="carFuel"/>-->
        <!--                <CustomCheckbox :checked-elements="carFuel" checked-value="4"></CustomCheckbox>-->
        <!--                <span>Електричеки</span>-->
        <!--            </label>-->
        <!--        </div>-->
    </div>
</template>

<script>
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {isUndefined, isArray} from "lodash";
import {useFetcher} from "../../../composables/fetcher";
import CustomCheckbox from "../../../components/ui/CustomCheckbox";

export default {
    name: "FuelFilter",
    components: {CustomCheckbox},
    emits: ['updateQueryParams'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();
        const {fetch} = useFetcher('fetch/fuels');

        // if (!isUndefined(fuel)) {
        //     carFuel.value.push(...isArray(fuel) ? fuel : [fuel])
        // }

        async function handleFuel(fuelValue) {
            await router.push({
                name: route.name,
                query: {...route.query, fuel: fuelValue}
            });

            emit('updateQueryParams');
        }

        return {
            fuels: fetch,
            route,
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
