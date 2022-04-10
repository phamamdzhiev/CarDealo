<template>
    <div>
        <VehicleType v-if="getStep === 1"/>
        <VehicleBrand v-if="getStep === 2"/>
        <VehicleModel v-if="getStep === 3"/>
        <VehicleYear v-if="getStep === 4"/>
        <component v-if="getStep === 5" :is="setComponent + 'Variant'"/>
        <VehicleExtras v-if="getStep === 6"/>
        <OfferDetails v-if="getStep === 7"/>
        <VehicleImages v-if="getStep === 8"/>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import VehicleType from "./VehicleType";
import VehicleBrand from "./VehicleBrand";
import VehicleModel from "./VehicleModel";
import SellCarVariant from "./variants/SellCarVariant";
import SellBusVariant from "./variants/SellBusVariant";
import SellBoatVariant from "./variants/SellBoatVariant";
import SellMotoVariant from "./variants/SellMotoVariant";
import SellTruckVariant from "./variants/SellTruckVariant";
import SellCaravanVariant from "./variants/SellCaravanVariant";
import VehicleYear from "./VehicleYear";
import VehicleExtras from "./VehicleExtras";
import OfferDetails from "./OfferDetails";
import VehicleImages from "./VehicleImages";
import Success from "./Success";

export default {
    name: "SellCar",
    props: ['vehicleID'],
    components: {
        BaseCard,
        VehicleType,
        VehicleBrand,
        VehicleModel,
        VehicleYear,
        SellCarVariant,
        SellCaravanVariant,
        VehicleExtras,
        OfferDetails,
        VehicleImages,
        Success,
        SellBusVariant,
        SellBoatVariant,
        SellMotoVariant,
        SellTruckVariant,
    },
    mounted() {
        this.$store.commit('uploadOffer/setVehicleState', {key: 'vehicleCategory', value: parseInt(this.vehicleID)});
    },
    computed: {
        setComponent() {
            switch (this.$route.params.vehicleID) {
                case '1':
                    return 'SellCar';
                case '2':
                    return 'SellBus';
                case '3':
                    return 'SellTruck';
                case '4':
                    return 'SellMoto';
                case '5':
                    return 'SellCaravan';
                case '6':
                    return 'SellBoat';
            }
        },
        getStep() {
            return this.$store.getters['uploadOffer/getStep'];
        },
        getAllData() {
            return this.$store.getters['uploadOffer/getVehicleState'];
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
