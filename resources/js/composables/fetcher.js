import axios from "axios";
import {ref} from 'vue';

export function useFetcher(routeName, params = null, speacial = true) {
    let urlBuilder;

    if (params) {
        urlBuilder = route(routeName, params);
    } else {
        urlBuilder = route(routeName);
    }

    const fetch = ref([]);
    const isLoading = ref(false);

    isLoading.value = true;
    axios.get(urlBuilder).then((res) => {
        isLoading.value = false;
        if (res.data) {
            if (speacial) {
                res.data.forEach((element) => {
                    fetch.value.push({label: element.name, value: element.id});
                });
            } else {
                fetch.value = res.data;
            }
        }
    }).catch(e => {
        if (process.env.NODE_ENV === 'development') {
            console.log(`Cannot fetch from ${urlBuilder}`, e);
        } else {
            console.log('Cannot resolve api endpoint from fetcher');
        }
    });
    return {
        fetch,
        isLoading
    }
}
