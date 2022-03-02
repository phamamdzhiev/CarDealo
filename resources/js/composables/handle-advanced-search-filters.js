import {useRouter, useRoute} from "vue-router";
import {ref} from "vue";

export default function (props, {emit}) {
    const router = useRouter();
    const route = useRoute();

    async function handleTransmission() {
        const aaa = {
            value: props.filter
        }

        await router.push({
            name: route.name,
            query: {...route.query,  }
        });

        emit('updateQueryParams');
    }

    return {
        handleTransmission
    }
}
