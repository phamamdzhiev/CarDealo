<template>
    <base-carousel banner-image="'https://stimg.cardekho.com/images/uploadimages/1642774416141/CD-1686x548-(2).png'" height="350"></base-carousel>
    <div class="container-xxl">
        <div class="merchants-list">
            <h4>Автокъщи</h4>
            <div class="merchant d-flex align-items-center justify-content-between" v-for="merchant in merchants">
                <div class="details">
                    <h5 class="fw-bold">{{merchant.merchant.name}}</h5>
                    <p>{{merchant.merchant.address}}</p>
                </div>
                <div class="actions">
                    <ul>
                        <li><router-link to="/">
                            Виж обяви (42)
                        </router-link></li>
                        <li>
                            <router-link to="/">
                                Намери на картата
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

export default {
    name: "Merchants.vue",
    components: {
        BaseCarousel
    },
    setup() {
        let merchants = ref(null);
        async function fetchMerchants() {
            const res = await axios.get('merchants/fetch');
            merchants.value = res.data.data;
        }

        onMounted(() => {
            fetchMerchants()
        })

        return {
            merchants
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
    border-right: 1px solid rgba(0,0,0,0.1);
}
</style>
