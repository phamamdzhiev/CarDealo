<template>
    <form @submit.prevent="logout">
        <button class="reset-btn-styles text-danger-color fw-bold d-flex align-items-center">
            <span>Изход</span>
            <span class="ms-2">
                <i class="bi bi-box-arrow-right fs-5 d-block-i"></i>
            </span>
        </button>
    </form>
</template>

<script>
import axios from "axios";

export default {
    name: "Logout",
    methods: {
        async logout() {
            this.$store.commit('uploadOffer/resetVehicleState');

            try {
                await axios.get('/sanctum/csrf-cookie');
                const res = await axios.post('/logout');

                if (res.data.success) {
                    window.location.href = '/';
                }

            } catch (e) {
                console.log('Logout failed', e);
            }
        }
    }
}
</script>
