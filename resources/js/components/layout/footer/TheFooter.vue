<template>
    <footer v-show="!$route.meta['hideFooter']">
        <div class="container">
            <div class="d-grid valuables">
                <div class="item">
                    <span><i class="bi bi-award fs-1"></i></span>
                    <div>
                        <h5 class="fw-bold">#1 в България</h5>
                        <p class="text-normal-gray">Най-новият Авто портал</p>
                    </div>
                </div>
                <div class="item">
                    <span><i class="bi bi-percent fs-1"></i></span>
                    <div>
                        <h5 class="fw-bold">Оферти</h5>
                        <p class="text-normal-gray">Намирате автомобил изгодно</p>
                    </div>
                </div>
                <div class="item">
                    <span><i class="bi bi-shield-check fs-1"></i></span>
                    <div>
                        <h5 class="fw-bold">Сравнете коли</h5>
                        <p class="text-normal-gray">Избирате правилният модел</p>
                    </div>
                </div>
                <div class="item">
                    <span><i class="bi bi-chat-dots fs-1"></i></span>
                    <div>
                        <h5 class="fw-bold">
                            Чат на живо
                        </h5>
                        <p class="text-normal-gray">7 дни в седмицата</p>
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
                        <li>
                            <a href="/">Рекламирай при нас</a>
                        </li>
                        <li>
                            <a href="/">Условия на ползване</a>
                        </li>
                        <li>
                            <a href="/">Политика на поверителност</a>
                        </li>
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
                <p class="text-normal-gray">&copy; {{ new Date().getFullYear() }} Miradi-22 Ltd.</p>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "TheFooter"
}
</script>
