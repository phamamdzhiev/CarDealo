<template>
    <FormKit
        type="select"
        placeholder="Изберете филтър"
        label="Качени от"
        name="sortBy"
        :options="options"
        v-model="uploadedBy"
    />
</template>

<script>
import {useStore} from "vuex";
import {computed, ref} from "vue";

export default {
    name: "UploadedBy",
    setup() {
        const store = useStore();
        const options = ref(
            [
                {value: 1, label: 'Само частни лица'},
                {value: 2, label: 'Само автокъщи'}
            ]
        )
        const uploadedBy = computed({
            get() {
                return store.getters['advancedFilters/getFilters']['uploadedBy'];
            },
            set(val) {
                store.commit('advancedFilters/setFilters', {filter: 'uploadedBy', value: val})
            }
        })

        return {
            options,
            uploadedBy
        }
    }
}
</script>
