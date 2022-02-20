<template>
    <header id="the__header">
        <div class="container-xxl">
            <div
                class="d-flex flex-row flex-nowrap align-items-center justify-content-between inner__header"
            >
                <div class="fs-4 logo">
                    <router-link to="/">{{ window.APP_NAME }}</router-link>
                </div>
                <div>
                    <nav id="nav" class="main__nav d-flex flex-nowrap align-items-center">
                        <div v-if="getUser" class="fw-bold me-3">
                            Здравейте, {{ getUser.name }}!
                            <router-link :to="{name:'Profile'}" class="d-flex flex-nowrap align-items-center">
                                <i class="bi bi-person-circle fs-6"></i>
                                <span class="ms-1">Профил</span>
                            </router-link>
                        </div>
                        <span v-else>
                           <router-link :to="{name: 'login'}" class="me-3">Вход / Регистрация</router-link>
                       </span>
                        <base-button :link="'sell-car'" class="special">+ Публикувай</base-button>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-xxl sub__nav">
            <nav
                class="d-flex flex-row flex-nowrap align-items-center"
            >
                <div
                    @mouseover="showSubMenuVisibility('old-cars')"
                    @mouseleave="hideSubMenuVisibility('old-cars')"
                    class="sub__menu__wrapper"
                >
                    <span>{{ window.APP_NAME }} ОБЯВИ</span>
                    <SubMenuHoverableItems
                        v-show="oldCarsItemShown"
                        :subLink="oldCarsSubLinks"
                    ></SubMenuHoverableItems>
                </div>
                <div
                    @mouseover="showSubMenuVisibility('sell-car')"
                    @mouseleave="hideSubMenuVisibility('sell-car')"
                    class="sub__menu__wrapper"
                >
                    <span>Продай своя автомобил</span>
                    <SubMenuHoverableItems
                        v-show="sellCarItemShown"
                        :subLink="sellCarSubLinks"
                    ></SubMenuHoverableItems>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
import SubMenuHoverableItems from "../../ui/hover-menu-items/SubMenuHoverableItems";
import BaseButton from "../../ui/base/BaseButton";
import axios from "axios";

export default {
    components: {
        SubMenuHoverableItems,
        BaseButton,
    },
    inject: ['window'],
    data() {
        return {
            newCarsItemShown: false,
            oldCarsItemShown: false,
            sellCarItemShown: false,
            oldCarsSubLinks: [
                {
                    id: 1,
                    link: "/usedCars",
                    linkText: `${window.APP_NAME} автомобили`,
                },
                {
                    id: 2,
                    link: "/merchants",
                    linkText: "Автокъщи",
                },
                {
                    id: 2,
                    link: "/my-listing",
                    linkText: "Моите обяви",
                },
            ],
            sellCarSubLinks: [
                {
                    id: 1,
                    link: "/sell-car",
                    linkText: "Публикувай обява",
                },
                {
                    id: 2,
                    link: "/pedal",
                    linkText: "Как работи?",
                },
                {
                    id: 3,
                    link: "/pedal",
                    linkText: "Често задавани въпроси",
                },
            ],
        };
    },
    computed: {
        getUser() {
            return this.$store.getters['auth/GET_AUTH_USER'];
        }
    },
    mounted() {
        this.$store.dispatch('auth/SET_USER_AUTH_ASYNC', window.AUTH);
    },
    methods: {
        showSubMenuVisibility(param) {
            switch (param) {
                case "new-cars":
                    this.newCarsItemShown = true;
                    break;
                case "old-cars":
                    this.oldCarsItemShown = true;
                    break;
                case "sell-car":
                    this.sellCarItemShown = true;
                    break;
                default:
                    break;
            }
        },
        hideSubMenuVisibility(param) {
            switch (param) {
                case "new-cars":
                    this.newCarsItemShown = false;
                    break;
                case "old-cars":
                    this.oldCarsItemShown = false;
                    break;
                case "sell-car":
                    this.sellCarItemShown = false;
                    break;
                default:
                    break;
            }
        },
    },
};
</script>

<style scoped>
#nav {
    white-space: nowrap;
}

#nav .base-button {
    margin: 0;
}
</style>
