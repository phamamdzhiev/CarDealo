<template>
    <div class="sell-car">
        <base-card>
            <span @click="setStepMinus" class="back__button">Назад <i class="fw-light">(Стъпка 4)</i></span>
            <TopBar/>
            <div class="question-section mb-3">
                <h5 class="fw-bold">Избери какви екстри има твоята кола</h5>
                <nav>
                    <ul id="car-extras-categories">
                        <li :class="{ active: showExtraCategory === 1 }" @click="showExtraCategory = 1">Безопастност
                        </li>
                        <li :class="{ active: showExtraCategory === 2 }" @click="showExtraCategory = 2">Комфорт</li>
                        <li :class="{ active: showExtraCategory === 3 }" @click="showExtraCategory = 3">Интериор</li>
                        <li :class="{ active: showExtraCategory === 4 }" @click="showExtraCategory = 4">Ектериор</li>
                        <li :class="{ active: showExtraCategory === 5 }" @click="showExtraCategory = 5">Защита</li>
                        <li :class="{ active: showExtraCategory === 6 }" @click="showExtraCategory = 6">Други</li>
                    </ul>
                </nav>
                <ul id="extras">

                    <!--<ul>-->
                    <!--<li v-for="item in items" :class="{highlight:selected2.includes(item.id)}"-->
                    <!--    @click="selected2.includes(item.id) ? selected2.splice(selected2.indexOf(item.id), 1) : selected2.push(item.id)">-->
                    <!--    {{ item.id }}-->
                    <!--</li>-->
                    <!--</ul>-->
                    <div v-show="showExtraCategory === 1" id="car-extra-category-1">
                        <li
                            v-for="item in getCarExtrasApi['car_extra_1']"
                            :key="item.id"
                            ref="element"
                            :class="{ active: selectedExtras.includes(item) }"
                            :data-extra-category="item['extra_category']"
                            :data-extra-name="item['extra']"
                            @click="selectedExtras.includes(item) ?
                                    selectedExtras.splice(selectedExtras.indexOf(item), 1) :
                                    selectedExtras.push(item)
                                   ">
                            {{ item.extra }}
                        </li>
                    </div>
                    <div v-show="showExtraCategory === 4" id="car-extra-category-4">
                        <li
                            v-for="ex in getCarExtrasApi['car_extra_4']"
                            :key="ex.id"
                            :data-extra-name="ex.extra"
                            ref="element"
                            @click="addToCollection(ex)"
                        >
                            {{ ex.extra }}
                        </li>
                    </div>
                </ul>
            </div>
            <div class="question-section mb-3">
                <div class="form-floating">
                    <select class="form-select form__input m-0" v-model="getAllData['car_color']"
                            id="floatingSelectCarColor">
                        <option value="Бял">Бял</option>
                        <option value="Черен">Черен</option>
                        <option value="Лилав">Лилал</option>
                        <option value="Бронз">Броз</option>
                        <option value="Металик">Металик</option>
                    </select>
                    <label for="floatingSelectCarColor">Моля изберете цвят</label>
                </div>
            </div>
            <div class="question-section">
                <div class="form-floating">
                    <select id="floatingSelectCarCategory" v-model="getAllData['car_category']"
                            class="form-select form__input m-0">
                        <option value="Ван">Ван</option>
                        <option value="Джип">Джип</option>
                        <option value="Кабрио">Кабрио</option>
                        <option value="Купе">Купе</option>
                        <option value="Седан">Седан</option>
                        <option value="Комби">Комби</option>
                    </select>
                    <label for="floatingSelectCarCategory">Моля изберете категория</label>
                </div>
            </div>
            <button class="base-button" @click="showStepSix" v-show="toggleNextStepButton">
                Следваща стъпка
            </button>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard.vue";
import TopBar from "./TopBar";
import {mapGetters, mapMutations} from "vuex";

export default {
    name: "SellCarExtras",
    components: {
        TopBar,
        BaseCard
    },
    data() {
        return {
            showExtraCategory: 1,
            selectedExtras: [],
            extra1: [],
            extra2: [],
            extra3: [],
            extra4: [],
            extra5: [],
            extra6: [],
        }
    },
    computed: {
        ...mapGetters('sellCar', ['getAllData', 'getCarExtrasApi']),

        toggleNextStepButton() {
            return !!(this.selectedExtras.length > 0 &&
                this.getAllData['car_category'] &&
                this.getAllData['car_color']
            );
        },
    },
    methods: {
        ...mapMutations('sellCar', ['setStepMinus', 'setCarColor', 'setCarCategory', 'setStepPlus']),

        showStepSix() {
            if (!this.toggleNextStepButton) return;

            this.$store.commit('sellCar/setCarExtras', this.selectedExtras);
            this.setStepPlus();
        },
    },
}
</script>

<style scoped>
.sell-car {
    max-width: 800px;
}

</style>

