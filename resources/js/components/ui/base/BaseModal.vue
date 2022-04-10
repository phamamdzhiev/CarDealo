<template>
    <teleport to="#app">
        <div class="modall shadow-lg" role="dialog" id="static">
            <div class="modal-mask">
                <div class="modal-dialg">

                    <div class="modal-content">
                        <div class="modal-top">
                            <button id="dismiss" @click="$emit('close-modal')">X</button>
                        </div>
                        <div class="modal-body">
                            <slot></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>

<script>
export default {
    name: "BaseModal",
    emits: ['close-modal']
}
</script>

<style scoped>
.modall {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    position: fixed;
    z-index: 5000;
}

#dismiss {
    background-color: transparent;
    color: #0D1C39;
    border: 0;
    margin-top: 7px;
    margin-left: 7px;
    font-size: 17px;
}

.modal-mask {
    background: rgba(0, 0, 0, 0.3);
    width: 100%;
    height: 100%;

}
.modal-body {
    width: 320px;
    margin: auto;
}

.modal-dialg {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 5001;
}
</style>
