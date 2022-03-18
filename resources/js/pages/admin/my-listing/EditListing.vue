<template>
    <div class="container-xxl mt-4">
        <i class="fa-solid fa-arrow-left-long pe-2"></i>
        <router-link :to="{name:'my.listing'}">Назад</router-link>
        <h4 class="text-center mb-4"><i class="fa-solid fa-pen-to-square"></i>
            Редакция на обява
        </h4>
        <spinner v-if="isLoading"/>
        <base-card v-else style="max-width: 650px; margin: auto">
            <FormKit
                type="form"
                submit-label="Запази промените"
                @submit="handleFormSubmit"
                incomplete-message="Моля, попълнете коректно всички задължителни полета"
            >
                <FormKit
                    type="text"
                    label="Заглавие"
                    v-model="editedOfferData.title"
                />
                <FormKit
                    type="textarea"
                    label="Описание"
                    v-model="editedOfferData.description"
                    rows="6"
                />
                <FormKit
                    type="number"
                    id="price"
                    name="price"
                    label="Цена"
                    :validation="dynamicValidations"
                    v-model="editedOfferData.price"
                    help="в лева"
                    :wrapper-class="{
                           'disabled': editedOfferData.hasPrice,
                         }"
                />
                <FormKit
                    type="checkbox"
                    v-model="editedOfferData.hasPrice"
                    @change="togglePrice"
                    name="hasPrice"
                    id="hasPrice"
                >
                    <template #label="context">
                        <i v-if="editedOfferData.hasPrice" class="bi bi-check-square fs-6"></i>
                        <i v-else class="bi bi-square fs-6"></i>
                        <span class="ps-1" style="cursor:pointer; user-select:none;">По договаряне?</span>
                    </template>
                </FormKit>
            </FormKit>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import axios from "axios";
import {onMounted, ref, computed, reactive} from "vue";

export default {
    name: "EditListing",
    components: {BaseCard},
    props: {
        uid: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const isLoading = ref(false);
        const editedOfferData = reactive({
            title: null,
            description: null,
            price: null,
            hasPrice: null
        });

        const dynamicValidations = computed(() => {
            if (editedOfferData.hasPrice) {
                return 'max:999999';
            } else {
                return 'required|number|max:999999|min:100';
            }
        });

        async function handleFormSubmit() {
            try {
                const res = await axios.patch(`offer/edit/${props.uid}`, editedOfferData);
                console.log('Edit was success');
            } catch (e) {
                if (e.response) {
                    console.error(e.response.data.message);
                }
            }

        }

        function togglePrice() {
            editedOfferData.price = null;
        }

        async function fetchOffer(props) {
            try {
                isLoading.value = true;
                const res = await axios.get(`fetch/offer/${props.uid}`);
                isLoading.value = false;
                if (res.data.success) {
                    editedOfferData.title = res.data.data.title;
                    editedOfferData.description = res.data.data.description;
                    editedOfferData.price = res.data.data.price;
                    editedOfferData.hasPrice = res.data.data.has_price;
                }
            } catch (e) {
                isLoading.value = false;
                console.log('Could not fetch offer in edit mode', e);
            }
        }

        onMounted(() => {
            fetchOffer(props)
        });

        return {
            isLoading,
            handleFormSubmit,
            dynamicValidations,
            editedOfferData,
            togglePrice
        }
    }
}
</script>
