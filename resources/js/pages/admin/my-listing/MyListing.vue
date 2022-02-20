<template>
    <div v-if="isloading">
        <h4 class="text-center">
            Зареджане...
        </h4>
    </div>
    <div class="container-xxl mt-4" v-else-if="listing.length > 0">
        <div class="d-flex justify-content-between">
            <div>
                <h6 class="fw-bold">Общо обяви: {{ listing.length }}</h6>
            </div>
            <div>
                <i :class="['bi bi-view-list fs-3 me-2', {'bordered': listingGridView === 1 }]"
                   @click="listingGridView = 1"></i>
                <i :class="['bi bi-grid fs-3', {'bordered': listingGridView === 2 }]" @click="listingGridView = 2"></i>
            </div>
        </div>
        <div class="row">
            <div :class="{'col-lg-3 col-sm-1': listingGridView === 2 }">
                <div class="base-card" v-for="(item, index) in listing" :key="item.id">
                    <div :class="['listing d-flex position-relative', {'flex-column': listingGridView === 2}]">
                        <div :class="['img-wrapper', {'mb-4': listingGridView === 2}]" >
                            <img
                                v-if="item.images.length > 0"
                                width="350"
                                class="img-fluid rounded"
                                :src="asset('storage/' + item.images[0].image)"
                                :alt="item['title']"
                            />
                            <img v-else :src="asset('storage/noimage.jpg')" class="img-fluid" alt="Default image">
                        </div>
                        <div class="details">
                            <h5 class="fw-bold">
                                {{ item['title'] }}
                            </h5>
                            <p class="text-base-color">{{ item['price'] }} лв.</p>
                            <p class="text-secondary-color mb-0">Колата е нов внос, регистрирана е преди 3 месеца,
                                напълно
                                обслужена
                                и всичко е платено за тази
                                година. Много запазена и поддържана, без забележки. Качваш се и караш. Заповядайте да я
                                видите,
                                може би е вашият автомобил.</p>
                        </div>
                        <div class="actions text-end position-absolute bottom-0 end-0 d-flex align-items-center">
                            <form>
                                <button class="btn p-0 me-2">
                                    <i class="bi bi-pencil-square text-success-color fs-4"></i>
                                </button>
                            </form>
                            <form @submit.prevent="handleDelete(item['id'], index)">
                                <button class="btn p-0 me-2">
                                    <i class="bi bi-trash text-error-color fs-4"></i>
                                </button>
                            </form>
                            <form>
                                <button class="btn p-0">
                                    <i class="bi bi-eye-slash text-secondary fs-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl text-center py-5 my-5" v-else>
        <h4>
            Все още нямате активни обяви. Може да добавите нова обява от
            <router-link class="text-base-color fw-bold" :to="{name: 'sell.car'}">
                ТУК
            </router-link>
        </h4>
    </div>
</template>

<script>
import axios from "axios";
import {onMounted, reactive, ref, inject} from "vue";
import BaseCard from "../../../components/ui/base/BaseCard";
import assetMixin from '../../../mixins/asset';

export default {
    name: "MyListing",
    components: {
        BaseCard
    },
    mixins: [assetMixin],
    setup() {
        let listing = ref([]);
        let listingGridView = ref(1);
        let isloading = ref(false);
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
            if (confirm('Сигурни ли сте, че искате да изтриета тази обява')) {
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
            listingGridView,
            handleDelete,
            isloading
        }
    }

}
</script>
<style scoped>
.details {
    margin-left: 1rem;
}

.flex-column .details {
    margin-left: 0;
}

.bordered {
    border-bottom: 2px solid #ff7771;
}

i {
    cursor: pointer;
}
</style>
