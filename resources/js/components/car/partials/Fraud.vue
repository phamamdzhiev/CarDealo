<template>
    <div class="fw-normal" @click="showModal">
        <i class="bi bi-flag fs-6 pe-1"></i>
        Сигнализирай
    </div>
    <base-modal
        v-if="isShown"
        @close-modal="closeModal"
    >
        <fraud-form :offer='offer'/>
    </base-modal>
</template>

<script>
import BaseModal from "../../ui/base/BaseModal";
import FraudForm from "./FraudForm";
import {ref} from "vue";

export default {
    name: "Fraud",
    components: {
        BaseModal,
        FraudForm
    },
    props: {
        offer: {
            type: Object,
            required: true
        }
    },
    setup() {
        const isShown = ref(false)

        function showModal() {
            isShown.value = true
        }

        function closeModal() {
            isShown.value = false
        }

        return {
            isShown,
            showModal,
            closeModal
        }
    }
}
</script>
