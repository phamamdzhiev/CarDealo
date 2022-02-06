<template>
    <div>
        My listing

        {{ listing }}
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import axios from "axios";
import {onMounted, ref} from "vue";

export default {
    name: "MyListing",

    setup() {
        let listing = ref(null);

        async function getUserListing() {
            try {
                const res = await axios.get('offers/fetch/user/listing');
                listing.value = res.data;
                console.log(res.data);
            } catch (e) {
                console.log(e, 'Cannot fetch listings');
            }
        }

        onMounted(async () => {
            await getUserListing();
        });


        return {
            listing
        }
    }

}
</script>
