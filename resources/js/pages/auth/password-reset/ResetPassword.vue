<template>
    <h4>Reset</h4>
    <p>{{getRouteParams}}</p>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
export default {
    name: "ResetPassword",
    components: {
        BaseCard
    },
    computed: {
        getRouteParams() {
            return this.$route.query
        }
    }

}
</script>

<style scoped>

</style>
