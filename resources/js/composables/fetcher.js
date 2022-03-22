import axios from "axios";
import {ref} from 'vue';

export function useFetcher(url) {
    const fetch = ref([]);
    const isLoading = ref(false);

    isLoading.value = true;
    axios.get(url).then((res) => {
        isLoading.value = false;
        // fetch.value = [];
        res.data.forEach((element) => {
            fetch.value.push({label: element.name, value: element.id});
        });
    }).catch(e => console.log(`Cannot fetch from ${url}`, e));

    return {
        fetch,
        isLoading
    }
}
