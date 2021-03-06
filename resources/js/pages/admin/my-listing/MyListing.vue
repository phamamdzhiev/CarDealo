<template>
    <spinner v-if="isloading"/>
    <div class="container-xxl mt-4" v-else-if="listing.length > 0">
        <div class="custom-container-md">
            <page-heading heading="Моите обяви"/>
            <h6>Общо обяви: {{ listing.length }}</h6>
            <div class="base-card position-relative" v-for="(item, index) in listing" :key="item.id">
                <div class="listing d-flex">
                    <router-link :to="{ name: 'single-listing', params: {uid: item.uid}}">
                        <div class="img-wrapper">
                            <img
                                v-if="item.images.length > 0"
                                width="200"
                                class="img-fluid rounded"
                                :src="asset(item.images[0].image)"
                                :alt="item['title']"
                            />
                            <img v-else :src="asset('noimage.jpg')" width="200" class="img-fluid rounded"
                                 alt="Default image">
                        </div>
                    </router-link>
                    <div class="details">
                        <h5>
                            <router-link :to="{ name: 'single-listing', params: {uid: item.uid}}">
                                {{ item['title'] }}
                            </router-link>
                        </h5>
                        <p class="text-base-color">
                            {{ item['price'] === 0 ? 'По договаряне' : item['price'] + ' лв.' }}</p>
                        <p class="text-secondary-color mb-0">
                            {{ item['description'] }}
                        </p>
                    </div>
                    <ul class="actions text-end position-absolute bottom-0 end-0 d-flex align-items-center p-2">
                        <li>
                            <p class="text-secondary-color mb-0 me-2" title="Преглеждания на обявата">
                                <i class="fa-solid fa-eye text-secondary fs-6"></i>
                                {{ item['visits'] }}
                            </p>
                        </li>
                        <li>
                            <router-link title="Редакция на обявата" class=" p-0 me-2"
                                         :to="{name: 'edit.listing', params: {uid: item.uid}}">
                                <i class="fa-solid fa-pen-to-square text-success-color fs-6"></i>
                            </router-link>
                        </li>
                        <li>
                            <form @submit.prevent="handleDelete(item['id'], index)">
                                <button title="Изтриване" class="btn p-0 me-2">
                                    <i class="fa-solid fa-trash text-danger-color fs-6"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl text-center py-5 my-5" v-else>
        <h4>
            Все още нямате активни обяви. Може да добавите нова обява от
            <router-link class="text-base-color" :to="{name: 'upload'}">
                ТУК
            </router-link>
        </h4>
    </div>
</template>

<script>
import axios from "axios";
import {onMounted, ref, inject} from "vue";
import BaseCard from "../../../components/ui/base/BaseCard";
import assetMixin from '../../../composables/asset';
import PageHeading from "../../../components/layout/PageHeading";

export default {
    name: "MyListing",
    components: {
        BaseCard,
        PageHeading
    },
    mixins: [assetMixin],
    setup() {
        const listing = ref([]);
        const isloading = ref(false);
        const $toast = inject('$toast');

        async function getUserListing() {
            try {
                isloading.value = true;
                const res = await axios.get('offers/fetch/user/listing');
                isloading.value = false;
                if (res.data.success) {
                    listing.value = res.data.offers;
                }
            } catch (e) {
                console.log(e.response.data.error, 'Cannot fetch listings');
            }
        }

        async function handleDelete(id, index) {
            if (confirm('Сигурни ли сте, че искате да изтриете тази обява')) {
                try {
                    const res = await axios.delete(`offer/delete/${id}`);
                    listing.value.splice(index, 1);
                    if (res.data.success) {
                        $toast.open({
                            message: "Успешно изтрихте обявата!",
                            type: 'success',
                            duration: 5000,
                            dismissible: true
                        })
                    }
                } catch (e) {
                    if (e.response.data) {
                        $toast.open({
                            message: "Грешка! Опитайте отново",
                            type: 'error',
                            duration: 5000,
                            dismissible: true
                        })
                        console.log(e.response.data.message, 'Cannot delete this offer');
                    }
                }
            }
        }

        onMounted(async () => {
            await getUserListing();
        });


        return {
            listing,
            handleDelete,
            isloading,
        }
    }
}
</script>
<style scoped lang="scss">
.details {
    margin-left: 1rem;
    @media screen and (max-width: 767px) {
        margin: 0.5rem;
        max-width: 100%;
        overflow: hidden;
    }
}

.base-card {
    @media screen and (max-width: 767px) {
        padding-bottom: 30px !important;
    }
}


.img-wrapper img:hover {
    transform: rotate(3deg);
}

.listing {
    @media screen and (max-width: 767px) {
        flex-flow: column wrap;
    }
}
</style>
