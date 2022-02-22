<template>
    <div>
        <VehicleType v-if="getStep === 1"/>
        <VehicleCategory v-if="getStep === 2"/>
<!--        <SellCarBrand v-if="getStep === 2"></SellCarBrand>-->
<!--        <SellCarModel v-if="getStep === 3"></SellCarModel>-->
<!--        <SellCarYear v-if="getStep === 4"></SellCarYear>-->
<!--        <SellCarVariant v-if="getStep === 5"></SellCarVariant>-->
<!--        <SellCarExtras v-if="getStep === 6"></SellCarExtras>-->
<!--        <OwnerDetails v-if="getStep === 7"></OwnerDetails>-->
<!--        <SellCarImages v-if="getStep === 8"></SellCarImages>-->
<!--        <SellCarFinal v-if="getStep === 9"></SellCarFinal>-->
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import VehicleType from "./VehicleType";
import VehicleCategory from "./VehicleCategory";


import SellCarBrand from "./SellCarBrand";
import SellCarYear from "./SellCarYear";
import SellCarModel from "./SellCarModel";
import SellCarVariant from "./SellCarVariant";
import SellCarExtras from "./SellCarExtras";
import SellCarImages from "./SellCarImages";
import OwnerDetails from "./OwnerDetails";
import SellCarFinal from "./SellCarFinal";

export default {
    name: "SellCar",
    components: {
        BaseCard,
        VehicleType,
        VehicleCategory,

        SellCarBrand,
        SellCarModel,
        SellCarYear,
        SellCarVariant,
        SellCarExtras,
        SellCarImages,
        OwnerDetails,
        SellCarFinal,
    },
    computed: {
        getStep() {
            return this.$store.getters['uploadOffer/getStep'];
        },
        getAllData() {
          return this.$store.getters['sellCar/getAllData'];
        }
    },
    async created() {
        //set all brands and extras from API
        // await this.$store.dispatch('sellCar/setCarExtrasApi');
    },
    beforeRouteLeave(to, from, next) {
        if (this.getAllData['car_brand']) {
            if (!window.confirm("Ако напуснете тази страница сега, възможно е да загубите информацията, която сте въвели!")) {
                return;
            }
        }
        this.setStepToOne();
        next();
    },
}
</script>
