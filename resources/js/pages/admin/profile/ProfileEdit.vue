<template>
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <form @submit.prevent="handleProfileEdit">
                    <h6 class="fw-bold">Смяна на мобилен номер</h6>
                    <div class="form-floating form-group">
                        <input type="text" class="form-control form__input"
                               placeholder="Смяна на мобилен номер"
                               name="Mobile"
                               id="mobile"
                        />
                        <label for="mobile">Нов мобилен номер</label>
                        <!--            <FromInputValidationMessage v-if="v$R.names.$error"-->
                        <!--                                        :messages="v$R.names.$errors"/>-->
                        <button class="btn base-button">Запази</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-sm-12">
                <form @submit.prevent="handleProfileEdit">
                    <h6 class="fw-bold">Промени парола</h6>
                    <div class="form-floating form-group">
                        <input type="password" class="form-control form__input"
                               placeholder="Стара парола"
                               name="passwordOld"
                               id="passwordOld"
                        />

                        <label for="password">Стара парола</label>
                        <!--            <FromInputValidationMessage v-if="v$R.names.$error"-->
                        <!--                                        :messages="v$R.names.$errors"/>-->
                    </div>
                    <div class="form-floating form-group">
                        <input type="password" class="form-control form__input"
                               placeholder="Стара парола"
                               name="password"
                               id="password"
                        />
                        <label for="password">Нова парола</label>
                        <!--            <FromInputValidationMessage v-if="v$R.names.$error"-->
                        <!--                                        :messages="v$R.names.$errors"/>-->
                    </div>
                    <button class="btn base-button">Запази</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProfileEdit",
    methods: {
        handleProfileEdit() {
            console.log('Edited!');
        }
    }
}
</script>

<style scoped>

</style>
