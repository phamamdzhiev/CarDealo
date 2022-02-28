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
                           <router-link :to="{name: 'login'}" class="me-3">Вход / Регистрация <i class="bi bi-door-open fs-5"></i> </router-link>
                       </span>
                        <base-button :link="'upload'" class="special">+ Публикувай</base-button>
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
                <div class="sub__menu__wrapper">
                    <router-link to="/merchants">
                        AВТОКЪЩИ
                    </router-link>
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
            oldCarsItemShown: false,
            sellCarItemShown: false,
            oldCarsSubLinks: [
                {
                    id: 1,
                    link: "/usedCars",
                    icon: 'fa-car',
                    linkText: `${window.APP_NAME} автомобили`,
                },
                {
                    id: 1,
                    link: "/usedCars",
                    icon: 'fa-bus-simple',
                    linkText: `${window.APP_NAME} бусове`,
                },
                {
                    id: 1,
                    link: "/usedCars",
                    icon: 'fa-truck',
                    linkText: `${window.APP_NAME} камиони`,
                },
                {
                    id: 1,
                    link: "/usedCars",
                    icon: 'fa-motorcycle',
                    linkText: `${window.APP_NAME} мотори`,
                },
                {
                    id: 1,
                    link: "/usedCars",
                    icon: 'fa-sailboat',
                    linkText: `${window.APP_NAME} лодки`,
                },
                {
                    id: 2,
                    link: "/my-listing",
                    icon: 'fa-bars-staggered',
                    linkText: "Моите обяви",
                },
            ],
            sellCarSubLinks: [
                {
                    id: 1,
                    link: "/upload",
                    icon: 'fa-plus',
                    linkText: "Публикувай обява",
                },
                {
                    id: 2,
                    link: "/pedal",
                    icon: "fa-network-wired",
                    linkText: "Как работи?",
                },
                {
                    id: 3,
                    link: "/pedal",
                    icon: 'fa-circle-question',
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
