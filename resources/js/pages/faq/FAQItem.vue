<template>
    <div>
        <h6 class="m-0">Въпрос <i class="fa-solid fa-question ps-1"></i></h6>
        <p class="faq-question text-base-color mb-2">{{ question }}</p>
        <h6 class="m-0">Отговор <i class="fa-solid fa-comment-dots ps-1"></i></h6>
        <p class="faq-answer text-base-color mb-2">{{ answer }}</p>
        <hr/>
    </div>
</template>

<script>
export default {
    name: "FAQItem",
    props: {
        question: {
            type: String,
            required: true,
        },
        answer: {
            type: String,
            required: true,
        }
    }
}
</script>

<style scoped lang="scss">
h6.m-0 {
    font-size: 14px;
}
</style>
