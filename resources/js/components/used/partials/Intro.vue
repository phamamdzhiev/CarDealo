<template>
    <BaseCard>
        <h5>{{ intro.heading }}</h5>
        <p>{{ intro.body }}</p>
    </BaseCard>
</template>

<script>
import BaseCard from "../../ui/base/BaseCard";

export default {
    name: "Intro",
    components: {
        BaseCard
    },
    props: {
        intro: {
            heading: {
                type: String
            },
            body: {
                type: String
            }
        },
    }
}
</script>

<style scoped>

</style>
