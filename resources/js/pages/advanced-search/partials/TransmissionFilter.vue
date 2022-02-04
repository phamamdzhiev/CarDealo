<template>
    <div class="advanced-single-filter">
        <h6 class="fw-bold">Трансмисия</h6>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="transmission" value="Ръчна" @change="handleTransmission"
                       v-model="carTransmission"
                />
                <CustomCheckbox :checked-elements="carTransmission" checked-value="Ръчна"></CustomCheckbox>
                <span>Ръчна</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="transmission" value="Автоматична" @change="handleTransmission"
                       v-model="carTransmission"
                />
                <CustomCheckbox :checked-elements="carTransmission" checked-value="Автоматична"></CustomCheckbox>
                <span>Автоматична</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" class="d-none" name="transmission" value="Полуавтоматична" @change="handleTransmission"
                       v-model="carTransmission"
                />
                <CustomCheckbox :checked-elements="carTransmission" checked-value="Полуавтоматична"></CustomCheckbox>
                <span>Полу-автоматична</span>
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
    name: "TransmissionFilter",
    components: {CustomCheckbox},
    setup() {
        const router = useRouter();
        const route = useRoute();
        let carTransmission = ref([]);


        if (!isUndefined(route.query.transmission)) {
            //TODO: handle case when query transmission is empty string, eg. reloading without transmission value
            carTransmission.value = route.query.transmission.split('-');
        }


        function handleTransmission() {
            router.push({
                name: route.name,
                query: {...route.query, transmission: carTransmission.value.join('-')}
            });
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
