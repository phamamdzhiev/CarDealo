<template>
    <form @submit.prevent="logout">
        <button class="btn text-error-color fw-bold">
            Изход
        </button>
    </form>
</template>

<script>
import axios from "axios";

export default {
    name: "Logout",
    methods: {
        async logout() {
            try {
                await axios.get('/sanctum/csrf-cookie');
                const res = await axios.post('/logout');

                if (res.data.success) {
                    window.location.href = '/';
                } else {
                    console.log(res)
                }
            } catch (e) {
                console.log('Logout failed', e);
            }
        }
    }
}
</script>
