<template>
    <base-carousel banner-image="'https://stimg.cardekho.com/images/uploadimages/1642774416141/CD-1686x548-(2).png'"
                   height="350"></base-carousel>
    <div class="container-xxl">
        <div class="merchants-list">
            <h4 class="fw-bold">Автокъщи</h4>
            <div class="row">
                <div class="col-4">
                    <merchants-filter/>
                </div>
            </div>
            <h6 class="fw-bold mt-4">Последно регистрирани</h6>
            <spinner v-if="isLoading"/>
            <div v-else-if="merchants.length > 0" class="merchant d-flex align-items-center justify-content-between"
                 v-for="merchant in merchants">
                <div class="img-wrapper me-3">
                    <router-link :to="{name: 'Merchant.offers', params: {id: merchant.id}}">
                        <img class="img-fluid rounded" width="100" :src="asset('app-images/avtokushta.jpg')" alt="">
                    </router-link>
                </div>
                <div class="details">
                    <h5 class="fw-bold">
                        <router-link :to="{name: 'Merchant.offers', params: {id: merchant.id}}">
                            {{ merchant.name }}
                        </router-link>
                    </h5>
                    <p>{{ merchant.address }}</p>
                </div>
                <div class="actions">
                    <ul>
                        <li class="d-flex align-items-center">
                            <router-link :to="{name: 'Merchant.offers', params: {id: merchant.id}}">
                                <span>Виж обяви</span>
                                <i class="fa-solid fa-angle-right ps-2"></i>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {onMounted, ref} from "vue";
import axios from "axios";
import BaseCarousel from "../../components/ui/base/BaseCarousel";
import assetMixin from "../../composables/asset";
import MerchantsFilter from "./MerchantsFilter";

export default {
    name: "Merchants.vue",
    components: {
        BaseCarousel,
        MerchantsFilter
    },
    mixins: [assetMixin],
    setup() {
        const merchants = ref([]);
        const isLoading = ref(false);

        async function fetchMerchants() {
            try {
                isLoading.value = true;
                const res = await axios.get('merchants/fetch');
                merchants.value = res.data.data;
                isLoading.value = false;
            } catch (e) {
                isLoading.value = false;
                console.log(e, 'Cannot fetch Merchant')
            }
        }

        onMounted(() => {
            fetchMerchants()
        })

        return {
            merchants,
            isLoading
        }
    }
}
</script>

<style scoped>
.merchants-list {
    max-width: 700px;
    margin: 1rem auto;
}

.merchant {
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgb(0 0 0 / 4%);
    margin-bottom: 1rem;
    background-color: white;
}

.details {
    flex-grow: 1;
    margin-right: 1rem;
    border-right: 1px solid rgba(0, 0, 0, 0.1);
}

.search-merchants {
    max-width: 275px;
}
</style>
