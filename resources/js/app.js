import AjaxLoadingSpinner from "./components/ui/AjaxLoadingSpinner";
require('./bootstrap');

import { createApp } from "vue";
import App from './App.vue';
import store from './store/index';
import router from "./router";
import axios from "axios";
axios.defaults.baseURL = 'http://127.0.0.1:8000';
axios.defaults.withCredentials = true;

const app = createApp(App);
app.component('loading-dots', AjaxLoadingSpinner);
app.use(store);
app.use(router);
app.mount('#app');
app.provide('window', window);

