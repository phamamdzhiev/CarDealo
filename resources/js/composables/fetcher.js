import axios from "axios";
import {ref} from 'vue';
import route from 'ziggy';
import {Ziggy} from './ziggy';
// import {useStore} from "vuex";

export function useFetcher(routeName, params = null, formKit = true) {
    let urlBuilder;

    if (params) {
        urlBuilder = route(routeName, params, undefined, Ziggy);
    } else {
        urlBuilder = route(routeName, undefined, undefined, Ziggy);
    }

    const fetch = ref([]);
    const isLoading = ref(false);
    // const store = useStore();

    isLoading.value = true;
    axios.get(urlBuilder).then((res) => {
        isLoading.value = false;
        if (res.data) {
            // store.commit('advancedFilters/setPreserver',
            //     {options: 'get.fuels', value: res.data}
            // );

            if (formKit) {
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
