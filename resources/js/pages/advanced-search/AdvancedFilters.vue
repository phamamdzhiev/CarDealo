<template>
    <div class="base-card container-xxl">
        <h4 class="fw-bold mb-4">
            <i class="fa-solid fa-magnifying-glass pe-2"></i>
            Подробно търсене
        </h4>
        <div class="advanced-search-wrapper" id="popular-filters">
            <popular-search-filters/>
        </div>
        <hr>
        <div class="advanced-search-wrapper" id="secondary-filters">
            <condition-filter/>
            <vehicle-category-filter/>
            <color-filter/>
            <region-filter/>
            <budget-filter/>
            <km-filter/>
            <city-filter/>
        </div>
        <submit-search/>
    </div>
</template>

<script>
import RegionFilter from "./partials/RegionFilter";
import ColorFilter from "./partials/ColorFilter";
import VehicleCategoryFilter from "./partials/VehicleCategoryFilter";
import ConditionFilter from "./partials/ConditionFilter";
import BudgetFilter from "./partials/BudgetFilter";
import KmFilter from "./partials/KmFilter";
import CityFilter from "./partials/CityFilter";
import SubmitSearch from "./partials/SubmitSearch";
import PopularSearchFilters from "../../components/simple-search/PopularSearchFilters";

export default {
    name: "AdvancedSearchNew",
    components: {
        CityFilter,
        KmFilter,
        VehicleCategoryFilter,
        RegionFilter,
        ColorFilter,
        BudgetFilter,
        PopularSearchFilters,
        ConditionFilter,
        SubmitSearch
    }
}
</script>

<style scoped>
.advanced-search-wrapper {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}
</style>
