<template>
    <div v-if="loading">
        Зареджане...
    </div>
    <div v-else-if="singleOffer && !loading">
        <div style="max-width: 750px; margin: auto">
            <div class="panel">
                <div class="offer-details p-4">
                    <div class="heading">
                        <h4 class="fw-bold">
                            <span>{{singleOffer.title}}</span>
                        </h4>
                        <div v-for="item in singleOffer.images">
                            <img
                                 class="img-fluid"
                                 :src="asset('storage/' + item.image)"
                                 alt=""
                            />
                        </div>
                        <h5 class="fw-bold">{{singleOffer.price}} лв.</h5>
                        <p>{{singleOffer.description}}</p>
                        <button class="fw-bold base-button">Виж детайли на собственика</button>
                    </div>
                </div>
                <div class="share-section">
                    <ul class="d-flex justify-content-between p-3">
                        <li class="fs-6"><i class="bi bi-heart fs-6"></i>Добави в любими</li>
                        <li><i class="bi bi-share fs-6"></i>Сподели</li>
                        <li><i class="bi bi-flag fs-6"></i>Сигнализирай</li>
                        <li><i class="bi bi-plus-lg fs-6"></i>Сравни с друга обява</li>
                    </ul>
                </div>
            </div>
            <div class="panel">
                <div class="offer-details p-4">
                    <div class="heading">
                        <h5 class="fw-bold">
                            <span>Детайли на офертата</span>
                        </h5>
                        <div>
                            <ul>
                                <li>{{singleOffer.hp}} к.с</li>
                                <li>{{singleOffer.transmission.name ?? ''}}</li>
                                <li>{{singleOffer.year}}</li>
                                <li>{{singleOffer.km}} км.</li>
                                <li>{{singleOffer.fuel.name ?? ''}}</li>
                                <li>{{singleOffer.user.is_business ? 'Търговец' : 'Частно лице'}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="offer-details p-4">
                    <div class="heading">
                        <h5 class="fw-bold">
                            <span>Спецификации и екстри</span>
                        </h5>
                        <div>
                            <ul>
                                <li>2016</li>
                                <li>203 400 км.</li>
                                <li>Бензин</li>
                                <li>Частно лице</li>
                                <li>Ръчка</li>
                                <li>105 к.с</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import {onMounted, ref, inject} from "vue";
import BaseCard from "../ui/base/BaseCard";
import router from "../../router";
import assetMixin from '../../composables/asset';

export default {
    name: "SingleListing",
    components: {BaseCard},
    mixins: [assetMixin],
    props: {
        id: String
    },
    setup(props) {
        let singleOffer = ref(null);
        let loading = ref(false);
        const $toast = inject('$toast');

        async function fetchSingleOffer() {
            try {
                loading.value = true;
                const res = await axios.get(`/fetch/offer/${props.id}`);
                loading.value = false;
                if (res.data.success) {
                    singleOffer.value = res.data.data;
                }
            } catch (e) {
                loading.value = false;
                if (e.response.data) {
                    $toast.open({
                        message: "Има проблем с тази обява, моля опитайте по-късно",
                        type: 'error',
                        dismissible: true,
                        duration: 5000,
                        //onDismiss: () => { router.replace({name: 'Home'}) }
                    });
                }
            }
        }

        onMounted(() => {
            fetchSingleOffer()
        });


        return {
            singleOffer,
            loading
        }
    }
}
</script>

<style scoped>
.share-section {
    border-top: 1px solid hsla(0, 0%, 59.2%, .2);
}

.panel {
    border-radius: 8px;
    background-color: white;
    box-shadow: 4px 4px 8px 0 rgb(36 39 44 / 6%);
    border: 1px solid #e9e9e9;
    overflow: hidden;
    margin-bottom: 1rem;

}

.base-button {
    box-shadow: 0 8px 8px 0 rgb(247 93 52 / 20%);
    max-width: 300px;
}
</style>
