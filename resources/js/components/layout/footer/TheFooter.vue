<template>
    <footer v-show="$route.name !== 'sell.car'">
        <div class="container">
            <div class="row valuables">
                <div class="item col-lg-3">
                    <span><i class="bi bi-award fs-1"></i></span>
                    <div>
                        <h5 class="fw-bold">#1 в България</h5>
                        <p class="text-normal-gray">Най-добрият Авто портал</p>
                    </div>
                </div>
                <div class="item col-lg-3">
                    <span><i class="bi bi-percent fs-1"></i></span>
                    <div>
                        <h5 class="fw-bold">Оферти</h5>
                        <p class="text-normal-gray">Намирате автомобил изгодно</p>
                    </div>
                </div>
                <div class="item col-lg-3">
                    <span><i class="bi bi-shield-check fs-1"></i></span>
                    <div>
                        <h5 class="fw-bold">Сравнете</h5>
                        <p class="text-normal-gray">Избирате правилният модел</p>
                    </div>
                </div>
                <div class="item col-lg-3">
                    <span><i class="bi bi-chat-dots fs-1"></i></span>
                    <div>
                        <h5 class="fw-bold">Чат на живо</h5>
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
                            <a href="/">За нас</a>
                        </li>
                        <li>
                            <a href="/">ЧЗВ</a>
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
                            <a href="/">Чат на живо</a>
                        </li>
                        <li>
                            <a href="/">Контактна форма</a>
                        </li>
                        <li>
                            <a href="/">support@cardealo.com</a>
                        </li>
                        <li>
                            <a href="/">Обратна връзка</a>
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
                <p class="text-normal-gray">&copy; {{ new Date().getFullYear() }} Miradi Software Ltd.</p>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "TheFooter"
}
</script>
