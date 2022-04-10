<template>
    <footer v-show="!$route.meta['hideFooter']" class="shadow">
        <div class="container">
            <div class="d-grid valuables">
                <div class="item" v-for="valuable in valuables" :key="valuable.id">
                    <span><i :class="`bi bi-${valuable.icon} fs-1`"></i></span>
                    <div>
                        <h5 class="fw-bold">{{valuable.title}}</h5>
                        <p class="text-normal-gray">{{valuable.subTitle}}</p>
                    </div>
                </div>
            </div>
            <hr />
            <div class="d-grid footer-link-sections">
                <div class="item">
                    <h6 class="fw-bold">Полезни страници</h6>
                    <ul>
                        <li>
                            <router-link :to="{name: 'contacts'}">За нас</router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'faq'}">ЧЗВ</router-link>
                        </li>
<!--                        <li>-->
<!--                            <a href="/">Рекламирай при нас</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="/">Условия на ползване</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="/">Политика на поверителност</a>-->
<!--                        </li>-->
                    </ul>
                </div>
                <div class="item">
                    <h6 class="fw-bold">Контакти</h6>
                    <ul>
                        <li>
                            <a href="/">
                                <i class="fa-solid fa-comment-dots pe-1"></i>
                                Чат на живо
                            </a>
                        </li>
                        <li>
                            <router-link :to="{name: 'contacts'}">
                                <i class="fa-solid fa-envelope pe-1"></i>
                                Контактна форма
                            </router-link>
                        </li>
                        <li>
                            <a href="/">
                                <i class="fa-solid fa-at pe-1"></i>
                                support@cardealo.com</a>
                        </li>
                    </ul>
                </div>
                <div class="item">
                    <h6 class="fw-bold">Последвайте ни</h6>
                    <ul class="d-flex flex-nowrap">
                        <li class="me-2">
                            <a href="/">
                                <i class="bi bi-facebook fs-4"></i>
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                <i class="bi bi-instagram fs-4"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr />
            <div class="copyright">
                <p class="text-normal-gray">Copywrite &copy; {{ new Date().getFullYear() }} Miradi-22 Ltd.</p>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "TheFooter",
    setup() {
        const valuables = [
            {id: 1, title: '#1 в България', subTitle: 'Най-новият Авто портал', icon: 'award'},
            {id: 2, title: 'Оферти', subTitle: 'Намирате автомобил изгодно', icon: 'percent'},
            // {id: 3, title: 'Сравнете коли', subTitle: 'Избирате правилният модел', icon: 'shield-check'},
            {id: 4, title: 'Чат на живо', subTitle: '7 дни в седмицата', icon: 'chat-dots'},
        ];

        return {
            valuables
        }
    }
}
</script>
