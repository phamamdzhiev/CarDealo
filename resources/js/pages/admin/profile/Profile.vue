<template>
    <BaseCard>
        <div class="row">
            <div class="col-lg-3" style="border-right: 1px solid #c6c6c6">
                <ul class="profile-settings-menu">
                    <li class="d-flex align-items-center">
                        <span class="me-2 fs-5"><i class="bi bi-house"></i></span>
                        <router-link :to="{name: 'Profile'}">
                            Начало
                        </router-link>
                    </li>
<!--                    <li class="d-flex align-items-center">-->
<!--                        <span class="me-2 fs-5">-->
<!--                            <i class="bi bi-chat-dots"></i>-->
<!--                        </span>-->
<!--                        <router-link :to="{name: 'Chat'}">Съобщения</router-link>-->
<!--                    </li>-->
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
                    <div class="user_avatar">
                        <img v-if="authUser.image_path" class="img-fluid rounded-circle" width="100" height="100" :src="asset('users/avatars/' + authUser.image_path)" alt="User Avatar">
                        <img v-else class="img-fluid" width="100" height="100" :src="asset('app-images/default-avatar.png')" alt="User Avatar">
                    </div>

                    <div class="user_details">
                        <h6><span class="fw-bold">Имена:</span> {{ authUser.name }}</h6>
                        <h6><span class="fw-bold">Имейл:</span> {{ authUser.email ? authUser.email : 'Не е посочен' }}</h6>
                        <h6><span class="fw-bold">Мобилен:</span> {{ authUser.mobile }}</h6>
                        <h6><span class="fw-bold">Регистриран на:</span> {{ authUser.created_at }}</h6>
                        <h6><span class="fw-bold">Бизнес профил:</span> {{ authUser.is_business ? 'Да' : 'Не' }}</h6>
                        <h6><span class="fw-bold">Брой обяви:</span> {{ '1' }}
                            <router-link :to="{name: 'my.listing'}">
                                (Виж обявите)
                            </router-link>
                        </h6>
                    </div>
                </div>
                <router-view v-else></router-view>
            </div>
        </div>
    </BaseCard>
</template>

<script>
import BaseCard from "../../../components/ui/base/BaseCard";
import Logout from "../../../components/layout/header/Logout";
import assetMixin from "../../../composables/asset";

export default {
    name: "Profile",
    components: {
        BaseCard,
        Logout
    },
    mixins: [assetMixin],
    data() {
        return {
            user: window.AUTH,
        }
    },
    computed: {
        authUser() {
            return this.$store.getters['auth/GET_AUTH_USER'];
        }
    }
}
</script>

<style scoped>

</style>
