<template>
    <div style="overflow: hidden" class="mb-4 p-2">
        <Swiper :slides-per-view="3"
                :space-between="20"
                :navigation="true"
                :modules="modules">
            <SwiperSlide v-for="img in editedOfferData.images" :key="img.image">
                <div id="swiper-img-wrapper" class="position-relative top-50 ">
                    <img class="img-fluid rounded" :src="asset(img.image)" alt="Offer images">
                    <div id="delete-action"
                         @click="handleDeleteImage(img)"
                         class="position-absolute top-50 start-50 translate-middle">
                        <i class="fa-solid fa-trash-can fs-2 text-danger-color"></i>
                    </div>
                </div>
            </SwiperSlide>
        </Swiper>
        <div class="mt-3" id="upload-img-wrapper">
            <FormKit type="form" submit-label="Качване на снимки"
                     @submit="submitHandler">
                <FormKit type="file" accept=".png,.jpg,.jpeg"
                         help="Позволени формати .png,.jpg,.jpeg"
                         label="Качване на снимка"
                         multiple
                         name="uploadListingImages"
                />
            </FormKit>
        </div>
    </div>
</template>

<script>
import assetMixin from '../../../../composables/asset';
import {Swiper, SwiperSlide} from "swiper/vue";
import {Navigation, Virtual} from "swiper";
import 'swiper/css';
import 'swiper/css/navigation';
import axios from "axios";
import {inject} from "vue";

export default {
    name: "EditListingImages",
    components: {
        Swiper,
        SwiperSlide,
        Navigation,
        Virtual
    },
    mixins: [assetMixin],
    props: {
        editedOfferData: {
            required: true,
            type: Object
        }
    },
    setup() {
        const swiperModules = [Navigation, Virtual];

        const window = inject('window');

        async function handleDeleteImage(img) {
            if (confirm('Сигурни ли сте, че искате да изтриете тази снимка')) {
                const imgID = img.id;

                const res = await axios.delete('image/destroy', {params: {id: imgID, userID: window.AUTH.id}});

                if (res.data.success) {
                    window.location.reload();
                }
            }
        }

        async function submitHandler(data) {
            const body = new FormData()

            const config = {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
                }
            }

            data.uploadListingImages.forEach((fileItem) => {
                body.append('uploadListingImages', fileItem.file)
            })

            await axios.post('offer/create', {
                body
            }, config);
        }

        return {
            modules: swiperModules,
            handleDeleteImage,
            submitHandler
        }

    }
}
</script>
<style scoped>
.formkit-outer {
    margin: 0 !important;
}

#upload-img-wrapper {
    max-width: 350px;
}

#swiper-img-wrapper {
    margin: auto;
}

#swiper-img-wrapper:hover #delete-action {
    display: inline-block;
    cursor: pointer;
}

#swiper-img-wrapper:hover:before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    margin: auto;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

#delete-action {
    display: none;
    z-index: 2;
    box-shadow: 0 4px 8px 0 rgb(36 39 44 / 10%), 0 2px 2px 0 rgb(36 39 44 / 10%);
}

.fa-trash-can:hover {
    opacity: 0.9;
}

#add-more-images {
    cursor: pointer;
}

#add-more-images:hover {
    opacity: 0.8;
}
</style>
