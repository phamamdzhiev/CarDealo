<template>
    <div class="custom-container-sm">
        <page-heading heading="Често задавани въпроси (FAQ)"></page-heading>
        <base-card>
            <FAQItem v-for="item in QA" :answer="item.a" :question="item.q"></FAQItem>
        </base-card>
    </div>
</template>

<script>
import PageHeading from "../../components/layout/PageHeading";
import BaseCard from "../../components/ui/base/BaseCard";
import {ref} from "vue";
import FAQItem from "./FAQItem";

export default {
    name: "FAQ",
    components: {
        PageHeading,
        BaseCard,
        FAQItem
    },
    setup() {
        const QA = ref([
            {id: 1, q: 'Kak se kazvash?', a: 'Starhil'},
            {id: 2, q: 'Kak se kazvash 1', a: 'Starhil 1'},
        ]);

        return {
            QA
        }
    }
}
</script>

<style scoped>

</style>
