<template>
    <BaseCard>
        <div class="row">
            <div class="col-lg-3" style="outline: 1px solid red; height: 300px">
                <ul>
                    <li>
                        <router-link :to="{name: 'Profile.edit'}">
                            Редактиране на профил
                        </router-link>
                    </li>
                    <li>Съобщения</li>
                    <li>
                        <router-link :to="{name: 'my.listing'}">Моите обяви</router-link>
                    </li>
                    <Logout></Logout>
                </ul>
            </div>
            <div class="col-lg-9" style="outline: 1px solid blue;">
                <router-view></router-view>
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
    inject: ['window'],
    data() {
        return {
            user: window.AUTH,
        }
    }
}
</script>

<style scoped>

</style>
