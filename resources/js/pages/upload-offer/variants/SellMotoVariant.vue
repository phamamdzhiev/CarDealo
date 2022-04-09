<template>
    <base-variant temp="moto">
        <Engine/>
        <Transmission/>
        <Hp/>
        <Cm/>
        <Km/>
    </base-variant>
</template>

<script>
import BaseVariant from "./BaseVariant";
import Engine from "../partials/dynamic/Engine";
import Transmission from "../partials/dynamic/Transmission";
import Hp from "../partials/dynamic/Hp";
import Cm from "../partials/dynamic/Cm"
import Km from "../partials/dynamic/Km"

export default {
    name: "SellMotoVariant",
    components: {
        Engine,
        Transmission,
        Hp,
        Cm,
        Km,
        BaseVariant
    }
}
</script>
