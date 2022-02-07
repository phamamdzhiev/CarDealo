require('./bootstrap');

import {createApp} from "vue";
import App from './App.vue';
import store from './store/index';
import router from "./router";
import axios from "axios";

import AjaxLoadingSpinner from "./components/ui/AjaxLoadingSpinner.vue";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
axios.defaults.withCredentials = true;

const app = createApp(App);
app.component('loading-dots', AjaxLoadingSpinner);

app.use(store);
app.use(VueToast);
app.use(router);
app.provide('window', window);
app.mount('#app');
