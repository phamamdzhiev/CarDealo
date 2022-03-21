<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Трансмисия</h6>
        <spinner v-if="transmission.length < 1"/>
        <FormKit
            v-else
            type="radio"
            id="transmission"
            name="transmission"
            :options="transmission"
            @input="handleTransmission"
            :value="route.query.transmission ? route.query.transmission : null"
        />
        <!--        <div class="form-group">-->
        <!--            <label>-->
        <!--                <input type="checkbox" class="d-none" name="transmission" value="1" @change="handleTransmission"-->
        <!--                       v-model="carTransmission"-->
        <!--                />-->
        <!--                <CustomCheckbox :checked-elements="carTransmission" checked-value="1"></CustomCheckbox>-->
        <!--                <span>Ръчна</span>-->
        <!--            </label>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label>-->
        <!--                <input type="checkbox" class="d-none" name="transmission" value="2" @change="handleTransmission"-->
        <!--                       v-model="carTransmission"-->
        <!--                />-->
        <!--                <CustomCheckbox :checked-elements="carTransmission" checked-value="2"></CustomCheckbox>-->
        <!--                <span>Автоматична</span>-->
        <!--            </label>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label>-->
        <!--                <input type="checkbox" class="d-none" name="transmission" value="3" @change="handleTransmission"-->
        <!--                       v-model="carTransmission"-->
        <!--                />-->
        <!--                <CustomCheckbox :checked-elements="carTransmission" checked-value="3"></CustomCheckbox>-->
        <!--                <span>Полу-автоматична</span>-->
        <!--            </label>-->
        <!--        </div>-->
    </div>
</template>

<script>
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {isArray, isUndefined} from "lodash";
import CustomCheckbox from "../../../components/ui/CustomCheckbox";
import {useFetcher} from "../../../composables/fetcher";

export default {
    name: "TransmissionFilter",
    components: {CustomCheckbox},
    emits: ['updateQueryParams'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();
        const {fetch} = useFetcher('fetch/transmissions');

        // const transmission = route.query['transmission[]'];

        // if (!isUndefined(transmission)) {
        //     carTransmission.value.push(...isArray(transmission) ? transmission : [transmission])
        // }

        async function handleTransmission(transmissionValue) {
            await router.push({
                name: route.name,
                query: {...route.query, transmission: transmissionValue}
            });

            emit('updateQueryParams');
        }

        return {
            transmission: fetch,
            handleTransmission,
            route
        }
    }
}
</script>
<style scoped>
label {
    font-weight: bold;
}

</style>
