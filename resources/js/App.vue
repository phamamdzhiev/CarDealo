<template>
    <div class="app-content">
        <the-header></the-header>
        <router-view></router-view>
        <the-footer></the-footer>
    </div>
</template>
<script>
import TheHeader from "./components/layout/header/TheHeader.vue";
import TheFooter from "./components/layout/footer/TheFooter";
import axios from 'axios';

export default {
    components: {
        TheHeader,
        TheFooter
    },
    async mounted() {
       // const res = await axios.get('/user/auth/fetch');
       //  console.log(res.data);
    }
};
</script>
<style>

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
