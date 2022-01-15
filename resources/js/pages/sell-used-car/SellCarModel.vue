<template>
  <div class="sell-car">
    <base-card>
      <span @click="back" class="back__button"
        >Назад <i class="fw-light">(Стъпка 1)</i></span
      >
      <TopBar />
      <div class="question-section">
        <h5 class="fw-bold">
          Какъв модел {{ getAllData["car_brand"] }} продаваш?
        </h5>
        <div class="form-group">
          <input
            type="text"
            id="search__model"
            class="form__input"
            :placeholder="setPlaceholder"
            v-model.trim="search"
          />
        </div>

        <ul id="model">
          <li
            v-for="(model, index) in filteredCarModelBySearchField"
            :key="model.id"
            :class="{ active: index === current }"
            @click="chooseModel(model.name, index)"
          >
            {{ model.name }}
          </li>
        </ul>
      </div>

      <button
        @click="showStepFour"
        v-show="dataStepThree.car_brand"
        class="base-button"
      >
        Следваща стъпка
      </button>
    </base-card>
  </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import TopBar from "./TopBar";

export default {
  name: "SellCarModel",
  components: {
    TopBar,
    BaseCard,
  },
  data() {
    return {
      search: "",
      current: null,
      dataStepThree: {
        car_brand: null,
      },
    };
  },
  methods: {
    back() {
      this.$store.commit("sellCar/setStepMinus");
    },
    showStepFour() {
      if (!this.dataStepThree.car_brand) {
        return;
      }
      this.$store.commit("sellCar/setCarModel", this.dataStepThree.car_brand);
      this.$store.commit("sellCar/setStepPlus");
    },
    chooseModel(modelName, index) {
        this.current = index;
        this.dataStepThree.car_brand = modelName;
    },
  },

  computed: {
    getAllData() {
      return this.$store.getters["sellCar/getAllData"];
    },
    getCarMakeWithModels() {
      return this.$store.getters["sellCar/getCarBrandWithModels"];
    },
    setPlaceholder() {
      return `Търси модел ${this.getAllData["car_brand"]}`;
    },
    filteredCarModelBySearchField() {
      if (this.search) {
        this.search = this.search.toLowerCase();
        return this.getCarMakeWithModels.filter((model) =>
          model.name.toLowerCase().includes(this.search)
        );
      } else {
        return this.getCarMakeWithModels;
      }
    },
  },
};
</script>

<style scoped>
a {
  display: block;
}
</style>
