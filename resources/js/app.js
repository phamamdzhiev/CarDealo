require('./bootstrap');

import {createApp} from "vue";

import App from './App.vue';
import store from './store/index';
import router from "./router";

import AjaxLoadingSpinner from "./components/ui/AjaxLoadingSpinner.vue";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import {plugin, defaultConfig} from '@formkit/vue'
import formKitConfig from "./formKitConfig";


const app = createApp(App);

app.component('loading-dots', AjaxLoadingSpinner);
app.use(router);
app.use(store);
app.use(VueToast);
app.use(plugin, defaultConfig(formKitConfig));
app.provide('window', window);
app.mount('#app');
