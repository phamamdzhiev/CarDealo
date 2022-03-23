<template>
    <router-link class="fw-bold text-link-blue advanced-search-link" :to="{name: 'advanced.filters', query: {type: defaultType}}">
        Подробно търсене
    </router-link>
</template>

<script>
export default {
    name: "AdvancedSearchRouterLink",
    props: {
        defaultType: {
            type: String,
            required: false,
            default: '1'
        }
    }
}
</script>
