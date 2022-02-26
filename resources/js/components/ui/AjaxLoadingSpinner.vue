<template>
    <div class="loader"></div>
</template>

<script>
import assetMixin from '../../mixins/asset';

export default {
    name: "AjaxLoadingSpinner",
    mixins: [assetMixin]
}
</script>

<style scoped>
.loader {
    border: 5px solid #e0e0e0;
    border-radius: 50%;
    border-top: 5px solid #ff7931;
    width: 50px;
    height: 50px;
    margin: 1rem auto;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
