<template>
    <base-carousel banner-image="'https://stimg.cardekho.com/images/uploadimages/1642774416141/CD-1686x548-(2).png'"
                   height="350"></base-carousel>
    <div class="container-xxl">
        <div class="merchants-list">
            <h4>Автокъщи</h4>
            <!-- <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <merchants-filter/>
                </div>
            </div> -->
            <h6 class="mt-4">Последно регистрирани</h6>
            <spinner v-if="isLoading"/>
            <div v-else-if="merchants.length > 0" class="merchant d-flex align-items-center justify-content-between"
                 :key="merchant.id"
                 v-for="merchant in merchants"> 
                <div class="img-wrapper me-3">
                    <router-link :to="{name: 'Merchant.offers', params: {id: merchant.id}}">
                        <img v-if="merchant.image" :src="asset(merchant.image)" class="img-fluid shadow-sm rounded"
                             width="100" alt="Merchant Avatar">
                        <img v-else :src="asset('noimage.jpg')" class="img-fluid shadow-sm rounded" width="100"
                             alt="Default Merchant Avatar">
                    </router-link>
                </div>
                <div class="details">
                    <h5>
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
import BaseCarousel from "../../components/ui/base/BaseCarousel";
import assetMixin from "../../composables/asset";
import MerchantsFilter from "./MerchantsFilter";
import {useFetcher} from "../../composables/fetcher";

export default {
    name: "Merchants.vue",
    components: {
        BaseCarousel,
        MerchantsFilter
    },
    mixins: [assetMixin],
    setup() {
        const {fetch: merchants, isLoading} = useFetcher('get.merchants', null, false);

        return {
            merchants,
            isLoading
        }
    }
}
</script>

<style scoped lang="scss">
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
    @media screen and (max-width: 767px) {
        flex-direction: column !important;
        align-items: flex-start !important;
        justify-content: flex-start !important;
    }
}

.details {
    flex-grow: 1;
    margin-right: 1rem;
    border-right: 1px solid rgba(0, 0, 0, 0.1);
    @media screen and (max-width: 767px) {
        border-right: 0;
        margin: 1rem 0 !important;
    }
}

.search-merchants {
    max-width: 275px;
    @media screen and (max-width: 767px) {
        max-width: 100%;
        width: 100%;
    }
}
</style>
