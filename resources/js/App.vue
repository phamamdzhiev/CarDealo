<template>
    <div class="app-content">
        <the-header></the-header>
        <router-view>
        </router-view>
    </div>
</template>
<script>
import TheHeader from "./components/layout/header/TheHeader.vue";
import axios from 'axios';

export default {
    components: {
        TheHeader,
    },
    async mounted() {
       // const res = await axios.get('/user/auth/fetch');
       //  console.log(res.data);
    }
};
</script>
<style>
html {
    /*font-size: 62.5%;*/
}

body {
    background-color: #fafafa;
    font-family: "Nunito", sans-serif;
}

header {
    background-color: white;
}

#app {
    /* text-align: center; */
    color: #2c3e50;
}

a {
    text-decoration: none;
    color: #2c3e50;
    font-weight: 700;
}

a:hover,
a:active {
    color: #fd5750;
}

ul {
    padding: 0;
    margin: 0;
    list-style: none;
}
</style>
