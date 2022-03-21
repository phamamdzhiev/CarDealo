<template>
    <div>
        <spinner v-if="Object.keys(merchant).length < 1"></spinner>
        <div v-else class="custom-container-md">
            <page-heading :heading="merchant.details.name"/>

            <base-card>
                <h4 class="text-center" v-if="merchant.offers.length < 1">
                    Няма намерени обяви за този търговец
                </h4>
                <div v-else class="d-grid" id="merchant-offers-wrapper">
                    <template v-for="m in merchant.offers" :key="m.uid">
                        <car-single-item :offer="m"/>
                    </template>
                </div>
            </base-card>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import BaseCard from "../../components/ui/base/BaseCard";
import PageHeading from "../../components/layout/PageHeading";
import CarSingleItem from "../../components/car/CarSingleItem";
import {onMounted, reactive} from "vue";

export default {
    name: "MerchantsOffers",
    components: {BaseCard, PageHeading, CarSingleItem},
    props: {
        id: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const merchant = reactive({});
        async function fetchSingleMerchant() {
            const res = await axios.get(`merchants/fetch/single/${props.id}`);
            if (res.data.success) {
                Object.assign(merchant, {offers: res.data.offers, details: res.data.merchant})
            }
        }

        onMounted(() => {
            fetchSingleMerchant()
        });

        return {
            merchant,
        }
    }
}
</script>
<style scoped lang="scss">
#merchant-offers-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px 15px;
}
</style>
