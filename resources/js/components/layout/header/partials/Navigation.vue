<template>
    <nav
        class="flex-row flex-nowrap align-items-center d-none d-sm-flex"
    >
        <div
            @mouseover="showSubMenuVisibility('old-cars')"
            @mouseleave="hideSubMenuVisibility('old-cars')"
            class="sub__menu__wrapper"
        >
            <span>{{ window.APP_NAME }} ОБЯВИ</span>
            <SubMenuHoverableItems
                v-show="oldCarsItemShown"
            ></SubMenuHoverableItems>
        </div>
        <div
            @mouseover="showSubMenuVisibility('sell-car')"
            @mouseleave="hideSubMenuVisibility('sell-car')"
            class="sub__menu__wrapper"
        >
            <router-link :to="{name: 'upload'}" class="text-uppercase">Качи обява</router-link>
        </div>
        <div class="sub__menu__wrapper">
            <router-link to="/merchants">
                AВТОКЪЩИ
            </router-link>
        </div>
    </nav>
</template>

<script>
import SubMenuHoverableItems from "../../../ui/hover-menu-items/SubMenuHoverableItems";

export default {
    name: "Navigation",
    components: {
        SubMenuHoverableItems
    },
    inject: ['window'],
    data() {
        return {
            oldCarsItemShown: false,
            sellCarItemShown: false,
        };
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
}
</script>

<style scoped>

</style>
