<template>
    <BaseCard>
        <h5 class="fw-bold">{{ by.heading }}</h5>
        <hr/>
        <div v-if="by.byFeature">
            <BaseGrid :items="by.byFeature"></BaseGrid>
        </div>
    </BaseCard>
</template>

<script>
import BaseCard from "../../ui/base/BaseCard";
import BaseGrid from "../../ui/base/BaseGrid";

export default {
    name: "By",
    components: {
        BaseCard,
        BaseGrid
    },
    props: {
        by: {
            heading: {
                type: String
            },
            byFeature: {
                type: Array
            }
        }
    }
}
</script>
