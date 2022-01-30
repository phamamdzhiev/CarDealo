<template>
    <header id="the__header">
        <div class="container-xxl">
            <div
                class="d-flex flex-row flex-nowrap align-items-center justify-content-between inner__header"
            >
                <div class="fs-4 logo">
                    <router-link to="/">{{ window.APP_NAME }}</router-link>
                </div>
                <nav id="nav" class="main__nav">
                    <router-link to="/" class="me-3">Вход</router-link>
                    <router-link to="/about" class="me-3"
                    >Регистрация</router-link
                    >
                    <base-button :link="'sell-car'" class="special"
                    >+ Публикувай</base-button
                    >
                </nav>
            </div>
        </div>
        <div class="container-xxl sub__nav">
            <nav
                class="d-flex flex-row flex-nowrap align-items-center"
            >
                <div
                    @mouseover="showSubMenuVisibility('new-cars')"
                    @mouseleave="hideSubMenuVisibility('new-cars')"
                    class="sub__menu__wrapper"
                >
                    <span>Нови автомобили</span>
                    <SubMenuHoverableItems
                        v-show="newCarsItemShown"
                        :subLink="newCarsSubLinks"
                    ></SubMenuHoverableItems>
                </div>
                <div
                    @mouseover="showSubMenuVisibility('old-cars')"
                    @mouseleave="hideSubMenuVisibility('old-cars')"
                    class="sub__menu__wrapper"
                >
                    <span>Използвани автомобили</span>
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
            newCarsSubLinks: [
                {
                    id: 1,
                    link: "/test",
                    linkText: "Търси в 'Нови коли'",
                },
                {
                    id: 2,
                    link: "/test",
                    linkText: "Популярни марки",
                },
                {
                    id: 3,
                    link: "/тестте",
                    linkText: "Последно качени",
                },
                {
                    id: 4,
                    link: "/тест",
                    linkText: "Дилъри",
                },
            ],
            oldCarsSubLinks: [
                {
                    id: 1,
                    link: "/usedCars",
                    linkText: `${window.APP_NAME} употребявани коли`,
                },
                {
                    id: 2,
                    link: "/city",
                    linkText: "Търси в твоя град",
                },
                {
                    id: 2,
                    link: "/pedal",
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

</style>
