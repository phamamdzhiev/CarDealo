import axios from "axios";
import {ref} from 'vue';

export function axiosFetcher(url) {
    const data = ref([]);
    const isLoading = ref(false);

    isLoading.value = true;
    axios.get(url).then(res => {
        isLoading.value = false;

        if (res.data) {
            data.value = res.data;
        }
    }).catch(e => {
        isLoading.value = false;
        console.log(`Could not fetch from fetcher ${url}`, e)
    });

    return {
        data,
        isLoading
    }
}
