<template>
    <div class="base-card d-flex justify-content-between">
        <div class="py-3">
            <h5 class="mb-0 fw-bold">{{ heading }}</h5>
            <p class="mb-0 text-normal-gray">{{ subHeading }}</p>
            <router-link :to="{name: linkHrefName}" class="mt-4 d-block text-link-blue">
                {{ linkLabel }}
            </router-link>
        </div>
        <img
            width="130"
            height="130"
            :src="image"
            alt="Vehicle SVG icon"
        />
    </div>
</template>

<script>
export default {
    name: "VehicleAndValuationAd",
    props: {
        heading: {
            type: String,
            required: true
        },
        subHeading: {
            type: String,
            required: true
        },
        linkLabel: {
            type: String,
            required: true
        },
        linkHrefName: {
            type: String,
            required: true
        },
        image: {
            type: String,
            required: true
        }
    }
}
</script>
