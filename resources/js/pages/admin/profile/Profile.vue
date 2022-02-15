<template>
    <BaseCard>
        <div class="row">
            <div class="col-lg-3" style="border-right: 1px solid #c6c6c6">
                <ul>
                    <li class="d-flex align-items-center">
                        <span class="me-2 fs-5"><i class="bi bi-house"></i></span>
                        <router-link :to="{name: 'Profile'}">
                            Начало
                        </router-link>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="me-2 fs-5">
                            <i class="bi bi-chat-dots"></i>
                        </span>
                        <router-link :to="{name: 'Chat'}">Съобщения</router-link>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="me-2 fs-5">
                            <i class="bi bi-list-task d-block-i"></i>
                        </span>
                        <router-link :to="{name: 'my.listing'}">Моите обяви</router-link>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="me-2 fs-5">
                            <i class="bi bi-pencil"></i>
                        </span>
                        <router-link :to="{name: 'Profile.edit'}">
                            Редактиране на профил
                        </router-link>
                    </li>
                    <li class="mt-3">
                        <Logout></Logout>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div v-if="$route.name === 'Profile'">
                    <h6>Имена: {{ user.name }}</h6>
                    <h6>Имейл: {{ user.email }}</h6>
                    <h6>Мобилен: {{ user.mobile }}</h6>
                </div>
                <router-view v-else></router-view>
            </div>
        </div>
    </BaseCard>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import Logout from "../../../components/layout/header/Logout";

export default {
    name: "Profile",
    components: {
        BaseCard,
        Logout
    },
    data() {
        return {
            user: window.AUTH,
        }
    },
    computed: {
        user() {
            return this.$store.getters['auth/GET_AUTH_USER'];
        }
    }
}
</script>

<style scoped>

</style>
