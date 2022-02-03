<template>
    <div class="gradient" style="margin: 55px auto auto 100px; max-width: max-content">
        <slot></slot>
        <div>
            <ul>
                <li :class="{active: filter === 1}" @click="changeFilter(1)">По бюджет</li>
                <li :class="{active: filter === 2}" @click="changeFilter(2)">По модел</li>
            </ul>
        </div>
        <form v-show="filter === 1" @submit.prevent="handleSimpleSearchSubmitByBudget">
            <div class="form-inner d-flex justify-content-center">
                <div class="form-group">
                    <select class="form-select">
                        <option>0 - 5000 лв.</option>
                        <option>5000 - 10 000 лв.</option>
                        <option>10 000 - 20 000 лв.</option>
                        <option>20 000 - 50 000 лв.</option>
                        <option>50 000 - 100 000 лв.</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-select">
                        <option>София</option>
                        <option>Пловдив</option>
                        <option>Варна</option>
                        <option>Бургас</option>
                        <option>Русе</option>
                        <option>Велико Търново</option>
                        <option>Стара Загора</option>
                    </select>
                </div>
                <div class="form-group p-2">
                    <button class="base-button ripple">
                        <i class="bi bi-search"></i>
                        <span class="ps-2">Търсене</span>
                    </button>
                </div>
            </div>
        </form>
        <form v-show="filter === 2" @submit.prevent="handleSimpleSearchSubmitByModel">
            <div class="form-inner d-flex justify-content-center">
                <div class="form-group">
                    <select class="form-select">
                        <option>Disabled select</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-select">
                        <option>Disabled select</option>
                    </select>
                </div>
                <div class="form-group p-2">
                    <button class="base-button ripple">
                        <i class="bi bi-search"></i>
                        <span class="ps-2">Търсене</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import BaseButton from "./base/BaseButton";
import {ref} from "vue";

export default {
    name: "SimpleSearch",
    components: {
        BaseButton
    },
    setup() {
        let filter = ref(1);

        function changeFilter(value) {
            filter.value = value;
        }

        function handleSimpleSearchSubmitByBudget() {
            console.log('by budget')
        }

        function handleSimpleSearchSubmitByModel() {
            console.log('by model')
        }

        return {
            handleSimpleSearchSubmitByBudget,
            handleSimpleSearchSubmitByModel,
            changeFilter,
            filter
        }
    }
}
</script>

<style scoped>
/*#simple-search-wrapper {*/
/*    position: absolute;*/
/*    top: 50%;*/
/*    left: 5rem;*/
/*}*/

form {
    background-color: white;
    max-width: max-content;

}

li {
    display: inline-block;
    background-color: #fd5750;
    transform: translateY(5px);
    margin-right: 5px;
    cursor: pointer;
    padding: 0.3rem 0.5rem;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    font-size: 14px;
    color: white;
}

li.active {
    box-shadow: 0 4px 8px 0 rgb(36 39 44 / 10%), 0 2px 2px 0 rgb(36 39 44 / 10%);
    color: black;
    padding: 0.4rem 0.5rem;
    transform: unset;
    background-color: white;
    font-size: 16px;
}

.form-select:focus {
    border: 0;
    box-shadow: none;
}

ul {
}

button {
    margin: 0;
}

.form-group {
    margin: 0;
}

.form-group:nth-child(1) {
    border-right: 1px solid #c6c6c6;
}

select {
    border: 0;
    height: 100%;
    border-radius: 0;
}
</style>
