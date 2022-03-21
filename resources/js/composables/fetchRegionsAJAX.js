import axios from "axios";
import {ref} from 'vue';

export function fetchRegions() {
    const regions = ref([]);

    axios.get('fetch/regions').then((res) => {
        res.data.data.forEach((element) => {
            regions.value.push({label: element.name, value: element.id});
        });
    }).catch(e => console.log('Cannot fetch regions', e));

    return {
        regions
    }
}
