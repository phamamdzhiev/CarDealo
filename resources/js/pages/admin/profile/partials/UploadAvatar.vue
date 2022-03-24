<template>
    <FormKit type="form" submit-label="Качи снимка" @submit="submitHandler">
        <FormKit type="file" label="Качване на лого/аватар"
                 accept=".png,.jpg,.jpeg"
                 name="avatar"
                 help="Позволени формати са .PNG, .JPG, .JPEG"
                 @input="createPreviewAvatar"
        />
        <img v-if="previewAvatar" :src="previewAvatar" width="150" class="img-thumbnail" alt="Avatar"/>
    </FormKit>
</template>

<script>
import {ref, inject} from 'vue';
import axios from "axios";

export default {
    name: "UploadAvatar",
    setup() {
        const previewAvatar = ref(null);
        const $toast = inject('$toast');

        function createPreviewAvatar(data) {
            const avatar = data[0];
            if (avatar && typeof avatar !== 'undefined') {
                // avatar temp url for preview
                previewAvatar.value = URL.createObjectURL(avatar.file);
            } else {
                previewAvatar.value = null;
            }
        }

        async function uploadAvatar(data) {
            const config = {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
                }
            }

            try {
                const res = await axios.post('', data, config);
                if (res.data) {
                    previewAvatar.value = null;

                    $toast.open({
                        message: "Успешно качихте снимката!",
                        type: 'success',
                        dismissible: true,
                        duration: 4000,
                    });
                }
            } catch (e) {
                console.log(e, 'Could not upload images');
                $toast.open({
                    message: "Има проблем с качване на снимката, моля опитайте отново",
                    type: 'error',
                    dismissible: true,
                    duration: 4000,
                });
            }
        }

        function submitHandler(data) {
            const avatar = data.avatar;

            if (avatar && typeof avatar !== 'undefined' && avatar.length > 0) {
                const fileSize = avatar[0].file.size;

                if (fileSize > 4194304) { //4MB in bytes
                    alert('Файлът трябва да е максимум 4 МБ');
                    return;
                }

                const formData = new FormData();
                formData.append('avatar', avatar);

                uploadAvatar(formData);
            }
        }

        return {
            submitHandler,
            previewAvatar,
            createPreviewAvatar
        }
    }
}
</script>
