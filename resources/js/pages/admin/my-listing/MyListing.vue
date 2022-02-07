<template>
    <div class="container-xxl mt-4" v-if="Object.keys(listing).length > 0">
        <div class="d-flex justify-content-between">
            <div>
                <h6 class="fw-bold">Общо обяви: {{ Object.keys(listing).length }}</h6>
            </div>
            <div>
                <i :class="['bi bi-view-list fs-3 me-2', {'bordered': listingGridView === 1 }]"
                   @click="listingGridView = 1"></i>
                <i :class="['bi bi-grid fs-3', {'bordered': listingGridView === 2 }]" @click="listingGridView = 2"></i>
            </div>
        </div>
        <div :class="{'grid-view': listingGridView === 2 }">
            <div class="base-card" v-for="item in listing">
                <div :class="['listing d-flex position-relative', {'flex-column': listingGridView === 2}]">
                    <div :class="['img-wrapper me-3', {'mb-4': listingGridView === 2}]">
                        <img
                            width="350"
                            class="img-fluid rounded"
                            :src="asset('storage/202202/3OAhXGbLClwOof08tyWavH3GrH65nbUXP3lyxR2Z.jpg')"
                            :alt="item['title']"
                        />
                    </div>
                    <div class="details">
                        <h5 class="fw-bold">
                            {{ item['title'] }}
                        </h5>
                        <p class="text-base-color">{{ item['price'] }} лв.</p>
                        <p class="text-secondary-color">Колата е нов внос, регистрирана е преди 3 месеца, напълно
                            обслужена
                            и всичко е платено за тази
                            година. Много запазена и поддържана, без забележки. Качваш се и караш. Заповядайте да я
                            видите,
                            може би е вашият автомобил.</p>
                    </div>
                    <div class="actions text-end position-absolute bottom-0 end-0">
                        <i class="bi bi-pencil-square text-success-color fs-4 me-3"></i>
                        <i class="bi bi-trash text-error-color fs-4 me-3"></i>
                        <i class="bi bi-eye-slash text-secondary fs-4"></i>
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
import {onMounted, reactive, ref} from "vue";
import BaseCard from "../../../components/ui/base/BaseCard";
import assetMixin from '../../../mixins/asset';

export default {
    name: "MyListing",
    components: {
        BaseCard
    },
    mixins: [assetMixin],
    setup() {
        let listing = reactive({});
        let listingGridView = ref(1);

        async function getUserListing() {
            try {
                const res = await axios.get('offers/fetch/user/listing');
                Object.assign(listing, res.data);
            } catch (e) {
                console.log(e.response.data.error, 'Cannot fetch listings');
            }
        }

        onMounted(async () => {
            await getUserListing();
        });


        return {
            listing,
            listingGridView
        }
    }

}
</script>
<style scoped>
.grid-view {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}

.bordered {
    border-bottom: 2px solid #ff7771;
}

i {
    cursor: pointer;
}
</style>
