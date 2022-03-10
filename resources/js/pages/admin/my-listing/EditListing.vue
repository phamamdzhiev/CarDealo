<template>
    <div class="container-xxl mt-4">
        <i class="fa-solid fa-arrow-left-long pe-2"></i>
        <router-link :to="{name:'my.listing'}">Назад</router-link>
        <h4 class="text-center mb-4"><i class="fa-solid fa-pen-to-square"></i>
            Редакция на обява
        </h4>
        <spinner v-if="!offer"/>
        <base-card v-else style="max-width: 650px; margin: auto">
            <FormKit
                type="form"
                submit-label="Запази промените"
                @submit.prevent="handleFormSubmit"
            >
                <FormKit
                    type="text"
                    label="Заглавие"
                    :value="offer.title"
                />
                <FormKit
                    type="textarea"
                    label="Описание"
                    :value="offer.description"
                    rows="6"
                />
                <FormKit
                    type="number"
                    id="price"
                    name="price"
                    label="Цена"
                    :validation="dynamicValidations"
                    :value="offer.price"
                    help="в лева"
                    :wrapper-class="{
                           'disabled': hasPrice,
                         }"
                />
                <FormKit
                    v-model="hasPrice"
                    type="checkbox"
                    name="hasPrice"
                    id="hasPrice"
                >
                    <template #label="context">
                        <i v-if="hasPrice" class="bi bi-check-square fs-6"></i>
                        <i v-else class="bi bi-square fs-6"></i>
                        <span class="ps-1" style="cursor:pointer; user-select:none;">По договаряне?</span>
                    </template>
                </FormKit>
            </FormKit>
            {{ offer }}
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
        const offer = ref(null);
        const editedOfferData = reactive({
            //TODO: add hasPrice here.. as well as the other data that will be editable
        });
        const hasPrice = ref(null);

        const dynamicValidations = computed(() => {
            if (hasPrice.value) {
                return 'max:999999';
            } else {
                return 'required|number|max:999999|min:100';
            }
        });

        function handleFormSubmit() {

        }

        async function fetchOffer(props) {
            try {
                const res = await axios.get(`fetch/offer/${props.uid}`);
                if (res.data.success) {
                    offer.value = res.data.data;
                    hasPrice.value = res.data.data.has_price;
                    console.log(offer.value);
                }
            } catch (e) {
                console.log('Could not fetch offer in edit mode', e);
            }
        }

        onMounted(() => {
            fetchOffer(props)
        });

        return {
            offer,
            handleFormSubmit,
            dynamicValidations,
            hasPrice
        }
    }
}
</script>
