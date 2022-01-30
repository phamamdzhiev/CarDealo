<template>
    <div class="d-grid">
        <div class="items" v-for="index in 12">
            {{ index }}
        </div>
    </div>
</template>

<style>
.d-grid {
    grid-template-columns: repeat(auto-fit, minmax(195px, 1fr));
    grid-template-rows: 1fr 1fr;
    justify-content: center;
    gap: 10px 15px;
}

.items {
    text-align: center;
    border: 2px solid pink;
    height: 170px;
}
</style>
<!--
1. Sofia
2. Plovdiv
3. Varna
4. Burgas
5. Ruse
6. Stara Zagora
7. Pleven
8. Qmbol
9. Pazarzhik
10. Blagoevgrad
11. Veliko Tarnovo
12. Vidin
-->
