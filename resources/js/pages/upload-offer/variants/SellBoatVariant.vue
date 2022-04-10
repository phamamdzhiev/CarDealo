<template>
    <base-variant>
        <Hp/>
        <Wade/>
        <Length/>
        <Width/>
        <WorkingHours/>
        <EngineType/>
        <Material/>
    </base-variant>
</template>

<script>
import BaseVariant from "./BaseVariant";
import Engine from "../partials/dynamic/Engine";
import Transmission from "../partials/dynamic/Transmission";
import Hp from "../partials/dynamic/Hp";
import Wade from "../partials/dynamic/Wade";
import Length from "../partials/dynamic/Length";
import Width from "../partials/dynamic/Width";
import EngineType from "../partials/dynamic/EngineType";
import WorkingHours from "../partials/dynamic/WorkingHours";
import Material from "../partials/dynamic/Material";

export default {
    name: "SellBoatVariant",
    components: {
        Engine,
        Transmission,
        Hp,
        Wade,
        Length,
        Width,
        EngineType,
        WorkingHours,
        Material,
        BaseVariant,
    }
}
</script>
