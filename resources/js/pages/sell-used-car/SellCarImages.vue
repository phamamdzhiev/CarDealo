<!--
chece this,image and this.imgTMp ,why with imgeTMo work, bbit not with image, wehn trying to get the len of the arr and it
pos
-->
<template>
    <div class="sell-car">
        <base-card>
            <span @click="back" class="back__button">Назад <i class="fw-light">(Стъпка 6)</i></span>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Тук може да качите снимките на автомобила</h5>
                <div id="car-images-upload">
                    <i
                        class="bi bi-info-circle-fill position-absolute"
                        id="info"
                        @mouseover="showInfo = true"
                        @mouseout="showInfo = false"
                    ></i>
                    <div class="position-absolute" id="imageInformationJumbotron" v-show="showInfo">
                        информация за снимкитес
                    </div>
                    <label for="upload-images">
                        <input type="file" v-show="false" id="upload-images" @change="imageChange" multiple>
                        <i class="bi bi-plus-circle-dotted"></i>
                        <p>(Моля, изберете между 5 и 15 снимки)</p>
                    </label>
                </div>
                <div id="car-image-gallery-preview" v-if="images">
                    <draggable v-model="imageTmpUrl" item-key="index">
                        <template #item="{element, index}">
                            <div class="position-relative">
                            <span v-if="index === 0" class="main-image position-absolute">
                                ОСНОВНА
                            </span>
                                <span style="z-index: 9999" @click="remove(index)" class="close-btn position-absolute">
                                <i class="bi bi-bookmark-x-fill"></i>
                            </span>
                                <img class="img-fluid" :src="element" alt="Car image"/>
                            </div>

                        </template>
                    </draggable>
                </div>
            </div>
            <error-display :errors="errors"></error-display>
            <!--            v-show="images.length > 4"-->
            <button @click="uploadOffer" class="base-button">
                <span v-if="!isLoading">Публикувай обява</span>
                <loading-dots v-else></loading-dots>
            </button>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import draggable from 'vuedraggable';
import ErrorDisplay from "../../components/ui/ErrorDisplay";
import {mapGetters} from "vuex";
import axios from "axios";

export default {
    name: "SellCarImages",
    components: {
        BaseCard,
        ErrorDisplay,
        draggable
    },
    inject: ['window'],
    data() {
        return {
            errors: [],
            images: [],
            imageTmpUrl: [],
            showInfo: false,
            formData: [],
            isLoading: false
        }
    },
    computed: {
        ...mapGetters('sellCar', ['getAllData', 'GET_OWNER_EMAIL']),
    },
    methods: {
        back() {
            this.$store.commit('sellCar/setStepMinus');
        },
        remove(index) {
            this.imageTmpUrl.splice(index, 1)
            this.images.splice(index, 1);
        },
        imageChange(e) {
            for (let i = 0; i < e.target.files.length; i++) {
                const ftype = e.target.files[i].type;
                const fsize = e.target.files[i].size;
                const file = Math.round((fsize / 1024));
                if (file >= 4096) {
                    this.errors = {'errors': ['Позволеният размер за 1 снимка е до 4MB']}
                } else if (!ftype.includes('image')) {
                    this.errors = {'errors': ['Позлените формати на файловете са .jpeg, .jpg и .png']}
                } else {
                    this.errors = [];
                    let url = URL.createObjectURL(e.target.files[i]);
                    this.imageTmpUrl.push(url);
                    this.images.push(e.target.files[i]);
                }

            }
        },
        async imageUpload() {
            let self = this;
            let formImages = new FormData();
            const lArr = this.images.length;

            for (let i = 0; i < lArr; i++) {
                let file = self.images[i];
                formImages.append('files[' + i + ']', file);
            }

            formImages.append('offer', JSON.stringify(self.getAllData));
            formImages.append('email', self.GET_OWNER_EMAIL);

            const config = {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
                }
            }
            this.isLoading = true

            try {
                await axios.post('offer/create', formImages, config);
            } catch (error) {
                this.errors = {'errors': ['Имаме проблем с качването на обявата. Опитайте отново по късно!']}
                throw new Error('Offer or images cannot be created or uploaded');
            }

            this.isLoading = false
        },
        async uploadOffer() {
            // const lArr = this.imageTmpUrl.length
            // if (lArr === 0) {
            //     alert(`Моля, качете снимки`);
            //     return
            // } else if (lArr < 5) {
            //     alert(`Моля, качете поне още ${5 - lArr} снимки`);
            //     return
            // } else if (lArr > 16) {
            //     alert(`Моля, изтриите ${lArr - 16} снимки`);
            //     return;
            // }

            // this.$store.commit('sellCar/setCarImages', this.images);
            await this.imageUpload();
            this.$store.commit('sellCar/resetState');
            this.$store.commit('sellCar/setStepPlus');
        }
    }
}
</script>

<style scoped>
.sell-car {
    max-width: 800px;
}
</style>
