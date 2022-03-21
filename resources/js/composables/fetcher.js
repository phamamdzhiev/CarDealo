import axios from "axios";
import {ref} from 'vue';

export function useFetcher(url) {
    const fetch = ref([]);

    axios.get(url).then((res) => {
        res.data.forEach((element) => {
            fetch.value.push({label: element.name, value: element.id});
        });

        console.log(fetch)
    }).catch(e => console.log(`Cannot fetch from ${url}`, e));

    return {
        fetch
    }
}
