<template>
    <base-variant>
        <Engine/>
        <Transmission/>
        <Hp/>
        <Cm/>
        <Km/>
        <Length/>
        <WC/>
        <Heating/>
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
import WC from "../partials/dynamic/WC"
import Length from "../partials/dynamic/Length";
import Heating from "../partials/dynamic/Heating"

export default {
    name: "SellCaravanVariant",
    components: {
        Engine,
        Transmission,
        Hp,
        Cm,
        Km,
        Load,
        Axis,
        WC,
        Length,
        Heating,
        BaseVariant
    }
}
</script>
