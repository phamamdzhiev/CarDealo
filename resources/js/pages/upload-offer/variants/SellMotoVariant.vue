<template>
    <base-variant>
        <Engine/>
        <Transmission/>
        <Hp/>
        <Cm/>
        <Km/>
        <EngineType/>
        <Cooling/>
    </base-variant>
</template>

<script>
import BaseVariant from "./BaseVariant";
import Engine from "../partials/dynamic/Engine";
import Transmission from "../partials/dynamic/Transmission";
import Hp from "../partials/dynamic/Hp";
import Cm from "../partials/dynamic/Cm"
import Km from "../partials/dynamic/Km"
import Cooling from "../partials/dynamic/Cooling";
import EngineType from "../partials/dynamic/EngineType";

export default {
    name: "SellMotoVariant",
    components: {
        Engine,
        Transmission,
        Hp,
        Cm,
        Km,
        Cooling,
        EngineType,
        BaseVariant
    }
}
</script>
