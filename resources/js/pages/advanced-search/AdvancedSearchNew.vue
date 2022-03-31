<template>
    <div class="base-card custom-container-lg">
        <h4 class="fw-bold mb-4">
            <i class="fa-solid fa-magnifying-glass pe-2"></i>
            Подробно търсене
        </h4>
        <div class="advance-search-wrapper">
            <vehicle-type-filter/>
            <FormKit
                type="select"
                name="type"
                label="Състояние"
                :options="['Употребяван', 'Нов', 'На части']"
            />
            <brand-filter/>
        </div>
        <hr>
        <div class="advance-search-wrapper">
            <model-filter/>
            <vehicle-category-filter/>
            <fuel-filter/>
            <transmission-filter/>
            <color-filter/>
            <region-filter/>
            <year-filter/>
            <budget-filter/>
            <km-filter/>
            <city-filter/>
        </div>
            <submit-search/>
    </div>
</template>

<script>
import FuelFilter from "./partials/FuelFilter";
import RegionFilter from "./partials/RegionFilter";
import ColorFilter from "./partials/ColorFilter";
import VehicleTypeFilter from "./partials/VehicleTypeFilter";
import TransmissionFilter from "./partials/TransmissionFilter";
import BrandFilter from "./partials/BrandFilter";
import VehicleCategoryFilter from "./partials/VehicleCategoryFilter";
import ModelFilter from "./partials/ModelFilter";
import YearFilter from "./partials/YearFilter";
import BudgetFilter from "./partials/BudgetFilter";
import KmFilter from "./partials/KmFilter";
import CityFilter from "./partials/CityFilter";
import SubmitSearch from "./partials/SubmitSearch";

export default {
    name: "AdvancedSearchNew",
    components: {
        CityFilter,
        KmFilter,
        YearFilter,
        ModelFilter,
        VehicleCategoryFilter,
        BrandFilter,
        FuelFilter,
        RegionFilter,
        ColorFilter,
        VehicleTypeFilter,
        TransmissionFilter,
        BudgetFilter,
        SubmitSearch
    }
}
</script>

<style scoped>
.advance-search-wrapper {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}
</style>
