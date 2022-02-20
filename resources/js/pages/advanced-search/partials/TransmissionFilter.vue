<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Трансмисия</h6>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="transmission" value="1" @change="handleTransmission"
                       v-model="carTransmission"
                />
                <CustomCheckbox :checked-elements="carTransmission" checked-value="1"></CustomCheckbox>
                <span>Ръчна</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="transmission" value="2" @change="handleTransmission"
                       v-model="carTransmission"
                />
                <CustomCheckbox :checked-elements="carTransmission" checked-value="2"></CustomCheckbox>
                <span>Автоматична</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="transmission" value="3" @change="handleTransmission"
                       v-model="carTransmission"
                />
                <CustomCheckbox :checked-elements="carTransmission" checked-value="3"></CustomCheckbox>
                <span>Полу-автоматична</span>
            </label>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {isArray, isUndefined} from "lodash";
import CustomCheckbox from "../../../components/ui/CustomCheckbox";

export default {
    name: "TransmissionFilter",
    components: {CustomCheckbox},
    emits: ['updateQueryParams'],
    setup(_, {emit}) {
        const router = useRouter();
        const route = useRoute();
        let carTransmission = ref([]);
        const transmission = route.query['transmission[]'];

        if (!isUndefined(transmission)) {
            carTransmission.value.push(...isArray(transmission) ? transmission : [transmission])
        }

        async function handleTransmission() {
            await router.push({
                name: route.name,
                query: {...route.query, 'transmission[]': carTransmission.value}
            });

            emit('updateQueryParams');
        }

        return {
            carTransmission,
            handleTransmission
        }
    }
}
</script>
<style scoped>
label {
    font-weight: bold;
}

</style>
