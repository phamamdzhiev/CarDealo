<template>
  <div class="container">
      <div id="simple-search">
          <div>
              <ul>
                  <li :class="{active: filter === 1}" @click="filter = 1">По бюджет</li>
                  <li :class="{active: filter === 2}" @click="filter = 2">По модел</li>
              </ul>
          </div>
          <form v-show="filter === 1" @submit.prevent="handleSimpleSearchSubmitByBudget">
              <div class="form-inner d-flex">
                  <div class="form-group">
                      <select class="form-select" v-model='budget'>
                          <option value="0-2000">0 - 2000 лв.</option>
                          <option value="2000-5000">2000 - 5 000 лв.</option>
                          <option value="5000-10000">5 000 - 10 000 лв.</option>
                          <option value="10000-20000">10 000 - 20 000 лв.</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <select class="form-select" v-model='city'>
                          <option value="София">София</option>
                          <option value="Пловдив">Пловдив</option>
                          <option value="Варна">Варна</option>
                          <option value="Стара Загора">Стара Загора</option>
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
                      <select class="form-select" v-model="carModel">
                          <option value="Audi">Audi</option>
                          <option value="Skoda">Skoda</option>
                          <option value="Opel">Opel</option>
                          <option value="Mercedez-Benz">Mercedez-Benz</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <select class="form-select" v-model='city'>
                          <option value="София">София</option>
                          <option value="Пловдив">Пловдив</option>
                          <option value="Варна">Варна</option>
                          <option value="Стара Загора">Стара Загора</option>
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
          <div class="text-end">
              <router-link to="/" class="text-link-blue">
                  Подробно търсене
              </router-link>
          </div>
      </div>
  </div>
</template>

<script>
import {ref} from "vue";
import {useRouter} from 'vue-router';

export default {
    name: "SimpleSearch",
    setup() {
        const router = useRouter();

        let filter = ref(1);
        let budget = ref("0-2000");
        let city = ref('София');
        let carModel = ref('Audi');

        function handleSimpleSearchSubmitByBudget() {
            router.push({name: 'used-cars', query: {budget: budget.value, city: city.value }})
        }

        function handleSimpleSearchSubmitByModel() {
            router.push({name: 'used-cars', query: {carModel: carModel.value, city: city.value }})
        }

        return {
            handleSimpleSearchSubmitByBudget,
            handleSimpleSearchSubmitByModel,
            filter,
            budget,
            city,
            carModel
        }
    }
}
</script>
