<template>
    <div>
        <VehicleCategory v-if="getStep === 1" />
        <VehicleBrand v-if="getStep === 2"></VehicleBrand>
        <component v-if="getStep === 3" :is="setComponent + 'Model'"/>
        <VehicleYear v-if="getStep === 4" ></VehicleYear>
        <component v-if="getStep === 5" :is="setComponent + 'Variant'"/>
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
import VehicleBrand from "./VehicleBrand";
import SellCarModel from "./cars/SellCarModel";
import VehicleYear from "./VehicleYear";
import SellCarVariant from "./cars/SellCarVariant";


import SellCarExtras from "./SellCarExtras";
import SellCarImages from "./SellCarImages";
import OwnerDetails from "./OwnerDetails";
import SellCarFinal from "./SellCarFinal";
import cars from "../../store/upload-offer/car";
export default {
    name: "SellCar",
    props: ['vehicleID'],
    components: {
        BaseCard,
        VehicleType,
        VehicleCategory,
        VehicleBrand,
        SellCarModel,
        VehicleYear,

        SellCarVariant,
        SellCarExtras,
        SellCarImages,
        OwnerDetails,
        SellCarFinal,
    },
    mounted() {
        this.$store.commit('uploadOffer/setState', {key: 'vehicleType', value: parseInt(this.vehicleID)});
    },
    computed: {
        setComponent() {
          switch (this.$route.params.vehicleID) {
              case '1':
                  this.$store.registerModule('carOffer', cars);
                  return 'SellCar';
          }
        },
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
    // beforeRouteLeave(to, from, next) {
    //     if (this.getAllData['car_brand']) {
    //         if (!window.confirm("Ако напуснете тази страница сега, възможно е да загубите информацията, която сте въвели!")) {
    //             return;
    //         }
    //     }
    //     this.setStepToOne();
    //     next();
    // },
}
</script>
