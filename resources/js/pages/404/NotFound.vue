<template>
    <div id="404">
        <div class="container">
            <div id="background"
                 class="d-flex justify-content-center align-items-center flex-column"
                 :style="{ backgroundImage: 'url(' + asset('storage/404_page.png') + ')'}">
                <div class="text-end">
                    <h1 class="text-base-color fw-bold">Ооопс...</h1>
                    <p class="text-secondary-color fs-4 mb-5">
                        Изглежда не можем да намерим страницата, която търсите.
                    </p>
                    <router-link class="base-button" :to="{name: 'Home'}">
                        Начална страница
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import assetMixin from '../../composables/asset';
import BaseButton from "../../components/ui/base/BaseButton";
export default {
    name: "NotFound",
    mixins: [assetMixin],
    components: {
        BaseButton
    }
}
</script>

<style scoped>
#background {
    padding: 3rem 1rem;
    min-height: 400px;
    background-size: contain;
    background-repeat: no-repeat;
}

h1 {
    font-size: 4.2rem;
}

.text-end {
    max-width: 500px;
}
</style>
