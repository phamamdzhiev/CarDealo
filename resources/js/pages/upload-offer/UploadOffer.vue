<template>
    <div>
        <VehicleCategory v-if="getStep === 1"/>
        <VehicleBrand v-if="getStep === 2"></VehicleBrand>
        <component v-if="getStep === 3" :is="setComponent + 'Model'"/>
        <VehicleYear v-if="getStep === 4"></VehicleYear>
        <component v-if="getStep === 5" :is="setComponent + 'Variant'"/>
        <VehicleExtras v-if="getStep === 6"></VehicleExtras>
        <OfferDetails v-if="getStep === 7"></OfferDetails>
        <VehicleImages v-if="getStep === 8"></VehicleImages>
        <Success v-if="getStep === 9"></Success>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import VehicleType from "./VehicleType";
import VehicleCategory from "./VehicleCategory";
import VehicleBrand from "./VehicleBrand";
import SellCarModel from "./cars/SellCarModel";
import SellCarVariant from "./cars/SellCarVariant";
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
        VehicleCategory,
        VehicleBrand,
        SellCarModel,
        VehicleYear,
        SellCarVariant,
        VehicleExtras,
        OfferDetails,
        VehicleImages,
        Success,
    },
    mounted() {
        this.$store.commit('uploadOffer/setVehicleState', {key: 'vehicleType', value: parseInt(this.vehicleID)});
    },
    computed: {
        setComponent() {
            switch (this.$route.params.vehicleID) {
                case '1':
                    return 'SellCar';
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
