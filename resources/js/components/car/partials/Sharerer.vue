<template>
    <div class="fw-normal" @click="showModal">
        <i class="bi bi-share fs-6 pe-1"></i>
        Сподели
    </div>
    <base-modal v-if="isShown"
                @close-modal="closeModal">
        <ul>
            <li class="mb-2">
                <a target="_blank" :href="`https://www.facebook.com/sharer/sharer.php?u=${$route.fullPath}`">
                    <i class="bi bi-facebook fs-5 pe-2"></i>Сподели във Facebook
                </a>
            </li>
            <li>
                <a target="_blank" :href="$route.fullPath">
                    <i class="fa-solid fa-clipboard fs-5 pe-1"></i>
                    Копирай линк
                </a>
            </li>
        </ul>
    </base-modal>
</template>

<script>
import BaseModal from "../../ui/base/BaseModal";
import {ref} from "vue";

export default {
    name: "Sharerer",
    components: {
        BaseModal
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

<style scoped>

</style>
