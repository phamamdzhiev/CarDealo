<template>
    <FormKit
        type="form"
        submit-label="Запази"
        incomplete-message="Моля, попълнете коректно всички задължителни полета"
        @submit="handleFormSubmit"
    >
        <FormKit
            type="textarea"
            label="Описание на автокъщата"
            rows="5"
            validation="length:1,750"
            help="до 750 символа"
            v-model="description"
            :key="elementKey"
        />
    </FormKit>
</template>

<script>
import {ref, inject, computed, watch} from "vue";
import axios from "axios";
import {useStore} from "vuex";
import {useFetcher} from "../../../../composables/fetcher";

export default {
    name: "Description",
    setup() {
        const {fetch: merchant} = useFetcher('get.auth.merchant', null, false);
        const description = ref('');
        const $toast = inject('$toast');
        const store = useStore();
        const elementKey = ref(0);


        watch(() => merchant.value, () => {
            if (Object.keys(merchant.value).length > 0) {
                description.value = merchant.value.description;
                //update elementKey so it can re-render FormKit
                //when u change :key on element it force render it
                elementKey.value++
            }
        });

        const user = computed(() => {
            return store.getters['auth/GET_AUTH_USER'];
        });

        async function handleFormSubmit() {
            try {
                const res = await axios.post('profile/upload/description',
                    {
                        'description': description.value,
                        'user': user.value
                    }
                );

                if (res.data.success) {
                    $toast.open({
                        message: "Успешно качихте описание!",
                        type: 'success',
                        dismissible: true,
                        duration: 4000,
                        onDismiss: () => {
                            // window.location.reload()
                        }
                    });
                }
            } catch (e) {
                console.log(e, 'Could not save description');
                $toast.open({
                    message: "Има проблем с описанието, моля опитайте отново",
                    type: 'error',
                    dismissible: true,
                    duration: 4000,
                });
            }
        }

        return {
            description,
            handleFormSubmit,
            elementKey
        }
    }
}
</script>
