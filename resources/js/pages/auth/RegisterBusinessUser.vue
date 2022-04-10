<template>
    <div>
        <h6>Данни за автокъщата</h6>
        <div class="form-floating form-group">
            <input type="text" class="form-control form__input"
                   placeholder="Име на автокъщата"
                   id="name"
                   v-model.trim.lazy="validation.company.$model"
            />
            <label for="name">Име на автокъщата</label>
            <small class="text-link-blue">
                <i>
                    Това е името, с което ще се представяте на сайта
                </i>
            </small>
            <FromInputValidationMessage v-if="validation.company.$error"
                                        :messages="validation.company.$errors"/>
        </div>
        <div class="form-floating form-group">
            <!--            <cleave-->
            <!--                class="form-control form__input"-->
            <!--                placeholder="Адрес на автокъщата"-->
            <!--                id="company"-->
            <!--                v-model.lazy.trim="validation.companyAddress.$model"-->
            <!--                :options="{prefix: 'ул'}"-->
            <!--            />-->
            <input type="text" class="form-control form__input"
                   placeholder="Адрес на автокъщата"
                   id="company"
                   v-model.lazy.trim="validation.companyAddress.$model"
            />
            <label for="company">Адрес на автокъщата</label>
            <small class="text-link-blue">
                <i>
                    Пример: ул. Раковска 25, гр. София
                </i>
            </small>
            <FromInputValidationMessage v-if="validation.companyAddress.$error"
                                        :messages="validation.companyAddress.$errors"/>
        </div>
        <div class="form-floating form-group">
            <input type="text" class="form-control form__input"
                   placeholder="ЕИК/Булстат"
                   id=eik
                   v-model.lazy.trim="validation.companyEik.$model"
            />
            <label for="eik">ЕИК/Булстат</label>
            <FromInputValidationMessage v-if="validation.companyEik.$error"
                                        :messages="validation.companyEik.$errors"/>
        </div>
    </div>
</template>

<script>
import FromInputValidationMessage from "../../components/ui/FromInputValidationMessage";
import Cleave from 'vue-cleave-component';

export default {
    name: "RegisterBusinessUser",
    components: {
        FromInputValidationMessage,
        Cleave
    },
    props: {
        validation: {
            required: true
        }
    },
    data() {
        return {}
    },
    methods: {}
}
</script>

<style scoped>

</style>
