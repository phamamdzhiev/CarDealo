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
            <budget-filter/>
            <vehicle-category-filter/>
            <km-filter/>
            <condition-filter/>
            <color-filter/>
            <region-filter/>
            <city-filter/>
            <sort-by-filter/>
            <uploaded-by/>
        </div>
        <div class="d-flex flex-nowrap align-items-center">
            <submit-search/>
            <clear-filters/>
        </div>
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
import ClearFilters from "./partials/ClearFilters";
import SortByFilter from "./partials/SortByFilter";
import UploadedBy from "./partials/UploadedBy";

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
        SubmitSearch,
        ClearFilters,
        SortByFilter,
        UploadedBy
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
