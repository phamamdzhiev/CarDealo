<template>
    <div>
        My listing
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "MyListing",
    computed: {
       ...mapGetters('authStore', ['HAS_USER_AUTH'])
    },
    mounted() {
        console.log(this.HAS_USER_AUTH)
    },
    beforeRouteEnter(to, from, next) {
        if (!this.HAS_USER_AUTH) {
            next('/login')
        } else {
            next();
        }
    },
}
</script>

<style scoped>

</style>
