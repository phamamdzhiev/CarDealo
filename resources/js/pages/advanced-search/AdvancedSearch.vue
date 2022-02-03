<template>
        <div style="height: 400px; background: pink">
            <h4>advanced search</h4>
        </div>
</template>

<script>
import axios from "axios";
import {onMounted, reactive} from "vue";
import {useRoute} from "vue-router";

export default {
    name: "AdvancedSearch",
    setup() {
        const router = useRoute();
        console.log(router.query)
    }

}
</script>

<style scoped>

</style>
