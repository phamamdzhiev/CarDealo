<template>
    <div class="custom-container-md">
            <page-heading heading="Името на автокъщата ЕООД"/>
        <base-card>
            to be rendered merchants offers here {{ id }}
        </base-card>
    </div>
</template>

<script>
import axios from "axios";
import BaseCard from "../../components/ui/base/BaseCard";
import PageHeading from "../../components/layout/PageHeading";
import {onMounted} from "vue";

export default {
    name: "MerchantsOffers",
    components: {BaseCard, PageHeading},
    props: ['id'],
    setup(props) {
        async function fetchSingleMerchant() {
            const res = await axios.get(`merchants/fetch/single/${props.id}`);
            console.log(res)
        }

        onMounted(() => {
            fetchSingleMerchant()
        });
    }
}
</script>

<style scoped>

</style>
