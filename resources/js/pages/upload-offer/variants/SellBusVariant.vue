<template>
    <base-variant temp="busove">
        <Engine/>
        <Transmission/>
        <Hp/>
        <Cm/>
        <Km/>
        <Axis/>
        <Load/>
    </base-variant>
</template>

<script>
import BaseVariant from "./BaseVariant";
import Engine from "../partials/dynamic/Engine";
import Transmission from "../partials/dynamic/Transmission";
import Hp from "../partials/dynamic/Hp";
import Cm from "../partials/dynamic/Cm"
import Km from "../partials/dynamic/Km"
import Load from "../partials/dynamic/Load"
import Axis from "../partials/dynamic/Axis"

export default {
    name: "SellBusVariant",
    components: {
        Engine,
        Transmission,
        Hp,
        Cm,
        Km,
        Load,
        Axis,
        BaseVariant
    }
}
</script>
