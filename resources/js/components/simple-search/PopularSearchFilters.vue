<template>
    <vehicle-type-filter/>
    <brand-filter/>
    <model-filter/>
    <year-filter/>
    <transmission-filter/>
    <fuel-filter/>
</template>

<script>
import VehicleTypeFilter from "../../pages/advanced-search/partials/VehicleTypeFilter";
import BrandFilter from "../../pages/advanced-search/partials/BrandFilter";
import ModelFilter from "../../pages/advanced-search/partials/ModelFilter";
import YearFilter from "../../pages/advanced-search/partials/YearFilter";
import TransmissionFilter from "../../pages/advanced-search/partials/TransmissionFilter";
import FuelFilter from "../../pages/advanced-search/partials/FuelFilter";

export default {
    name: "PopularSearchFilters",
    components: {
        VehicleTypeFilter,
        BrandFilter,
        ModelFilter,
        YearFilter,
        TransmissionFilter,
        FuelFilter
    }
}
</script>
