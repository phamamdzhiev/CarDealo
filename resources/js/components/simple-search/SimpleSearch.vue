<template>
    <div class="base-card  py-4 bg-white shadow mb-5">
        <h4 class="fw-bold mb-4">
            <i class="fa-solid fa-magnifying-glass pe-2"></i>
            {{ heading }}
        </h4>
        <div class="d-grid" id="simple_search">
            <popular-search-filters/>
            <advanced-search-router-link/>
            <submit-search/>
        </div>
    </div>
</template>

<script>
import AdvancedSearchRouterLink from "../../pages/advanced-search/partials/AdvancedSearchRouterLink";
import PopularSearchFilters from "./PopularSearchFilters";
import SubmitSearch from "../../pages/advanced-search/partials/SubmitSearch";

export default {
    name: "SimpleSearch",
    components: {
        AdvancedSearchRouterLink,
        PopularSearchFilters,
        SubmitSearch
    },
    props: {
        heading: {
            type: String,
            required: false,
            default: "Търсене"
        }
    }
}
</script>
<style scoped>
.advanced-search-link {
    align-self: center;
    display: inline;
    justify-self: flex-start;
}

.base-card {
    margin-top: -2.275rem;
    position: relative;
    z-index: 5000;
}

.base-button {
    grid-column: 3;
}

#simple_search {
    grid-template-columns: repeat(3, 1fr);
    gap: 15px
}
</style>
