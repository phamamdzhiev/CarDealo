<template>
  <div class="base-card container-xxl">
    <h4 class="mb-4">
      <i class="fa-solid fa-magnifying-glass pe-2"></i>
      Подробно търсене
    </h4>
    <p>Категория <strong class="text-base-color">автомобили</strong></p>

    <div class="advanced-search-wrapper" id="popular-filters">
      <popular-search-filters />
    </div>
    <hr />
    <div class="advanced-search-wrapper" id="secondary-filters">
      <budget-filter />
      <vehicle-type-filter />
      <km-filter />
      <condition-filter />
      <color-filter />
      <region-filter />
      <city-filter />
      <sort-by-filter />
      <uploaded-by />
    </div>
    <div class="d-flex flex-nowrap align-items-center">
      <submit-search />
      <clear-filters />
    </div>
  </div>
</template>

<script>
import RegionFilter from "./partials/RegionFilter";
import VehicleTypeFilter from "./partials/VehicleTypeFilter";
import ColorFilter from "./partials/ColorFilter";
import ConditionFilter from "./partials/ConditionFilter";
import BudgetFilter from "./partials/BudgetFilter";
import KmFilter from "./partials/KmFilter";
import CityFilter from "./partials/CityFilter";
import SubmitSearch from "./partials/SubmitSearch";
import PopularSearchFilters from "../../components/simple-search/PopularSearchFilters";
import ClearFilters from "./partials/ClearFilters";
import SortByFilter from "./partials/SortByFilter";
import UploadedBy from "./partials/UploadedBy";

export default {
  name: "AdvancedSearchNew",
  components: {
    CityFilter,
    KmFilter,
    VehicleTypeFilter,
    RegionFilter,
    ColorFilter,
    BudgetFilter,
    PopularSearchFilters,
    ConditionFilter,
    SubmitSearch,
    ClearFilters,
    SortByFilter,
    UploadedBy,
  },
};
</script>

<style scoped lang="scss">
.advanced-search-wrapper {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 15px;
  @media screen and (max-width: 767px) {
    grid-template-columns: 1fr;
  }
}
</style>
