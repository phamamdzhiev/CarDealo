<template>
    <!-- <vehicle-category-filter/> -->
    <brand-filter/>
    <model-filter/>
    <year-filter/>
    <transmission-filter/>
    <fuel-filter/>
</template>

<script>
import VehicleCategoryFilter from "../../pages/advanced-search/partials/VehicleCategoryFilter";
import BrandFilter from "../../pages/advanced-search/partials/BrandFilter";
import ModelFilter from "../../pages/advanced-search/partials/ModelFilter";
import YearFilter from "../../pages/advanced-search/partials/YearFilter";
import TransmissionFilter from "../../pages/advanced-search/partials/TransmissionFilter";
import FuelFilter from "../../pages/advanced-search/partials/FuelFilter";

export default {
    name: "PopularSearchFilters",
    components: {
        VehicleCategoryFilter,
        BrandFilter,
        ModelFilter,
        YearFilter,
        TransmissionFilter,
        FuelFilter
    }
}
</script>
