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
                    <div class="user_details">
                        <h6><span>Имена:</span> {{ authUser.name }}</h6>
                        <h6><span>Имейл:</span> {{ authUser.email ? authUser.email : 'Не е посочен' }}
                        </h6>
                        <h6><span>Мобилен:</span> {{ authUser.mobile }}</h6>
                        <h6><span>Регистриран на:</span> {{ authUser.created_at }}</h6>
                        <h6><span>Бизнес профил:</span> {{ authUser.is_business ? 'Да' : 'Не' }}</h6>
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
