<template>
    <div class="vehicle-singleton">
        <div class="vehicle-image-wrapper">
            <img class="img-fluid" src="https://images10.gaadicdn.com/usedcar_image/320x240/VCC_1333743_24_1642322761.jpg" alt="">
        </div>
        <div class="vehicle-details">
            <router-link to="/car/1">
                2019 BMW M3 xDrive
            </router-link>
            <div class="price">
                23 500 <span>BGN</span>
            </div>
            <div class="dotlist text-normal-gray">
                <span>450 800 км</span>
                <span>Бензин</span>
                <span>Пловдив</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CarSingleItem"
}
</script>
