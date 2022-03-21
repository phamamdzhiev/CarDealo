import axios from "axios";
import {ref} from 'vue';

export function fetchColors() {
    const colors = ref([]);

    axios.get('fetch/colors').then((res) => {
        res.data.data.forEach((element) => {
            colors.value.push({label: element.name, value: element.id});
        });
    }).catch(e => console.log('Cannot fetch regions', e));

    return {
        colors
    }
}
