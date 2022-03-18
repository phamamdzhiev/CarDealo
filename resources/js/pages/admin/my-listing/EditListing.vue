<template>
    <div class="custom-container-sm mt-4">
        <page-heading heading="Редакция на обява"></page-heading>
        <spinner v-if="isLoading"/>
        <base-card v-else>
            <edit-listing-images :edited-offer-data="editedOfferData"></edit-listing-images>
            <hr/>
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
            <hr>
            <router-link :to="{name: 'my.listing'}"
                         class="fw-bold text-link-blue">
                <i class="fa-solid fa-xmark pe-1"></i>
                Отказ
            </router-link>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import PageHeading from "../../../components/layout/PageHeading";
import EditListingImages from "./partials/EditListingImages";
import axios from "axios";
import {onMounted, ref, computed, reactive} from "vue";


export default {
    name: "EditListing",
    components: {
        EditListingImages,
        BaseCard, PageHeading,
    },
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
            hasPrice: null,
            images: []
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
                    editedOfferData.images = res.data.data.images
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
            togglePrice,
        }
    }
}
</script>
