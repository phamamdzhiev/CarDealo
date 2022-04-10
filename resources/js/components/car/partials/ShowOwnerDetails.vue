<template>
    <button class="base-button" @click="showModal">Виж детайли на собственика</button>
    <base-modal
        v-if="isShown"
        @close-modal="closeModal"
    >
        <h5 class="mb-4">Контакти със собсветника</h5>
        <ul>
            <li class="fs-5 mb-3" v-if="offer.user.name">
                <span class="pe-2">
                    <i class="fa-solid fa-user pe-1"></i>
                </span>
               <span>
                    {{ offer.user.name }}
               </span>
            </li>
            <li class="fs-5" v-if="offer.user.mobile">
                <span class="pe-2">
                   <i class="fa-solid fa-mobile-screen-button pe-1"></i>
                </span>
                <span>
                    <a :href="`tel:${offer.user.mobile}`">
                        {{ offer.user.mobile }}
                    </a>
                </span>
            </li>
        </ul>
    </base-modal>

</template>

<script>
import BaseModal from "../../ui/base/BaseModal";
import {ref} from "vue";

export default {
    name: "ShowOwnerDetails",
    props: ['offer'],
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
.base-button {
    box-shadow: 0 8px 8px 0 rgb(247 93 52 / 20%);
    max-width: 300px;
}
</style>
