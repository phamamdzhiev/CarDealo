
require('./bootstrap');

import {createApp} from "vue";

import DotsLoader from "./components/ui/DotsLoader";
import App from './App.vue';
import store from './store/index';
import router from "./router";
// import { ZiggyVue } from 'ziggy';
// import { Ziggy } from './ziggy';
import AjaxLoadingSpinner from "./components/ui/AjaxLoadingSpinner.vue";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import {plugin, defaultConfig} from '@formkit/vue'
import formKitConfig from "./formKitConfig";
import '@formkit/themes/genesis';

const app = createApp(App);

app.component('loading-dots', DotsLoader);
app.component('spinner', AjaxLoadingSpinner);

// app.use(ZiggyVue, Ziggy)
app.use(router);
app.use(store);
app.use(VueToast);
app.use(plugin, defaultConfig(formKitConfig));
app.provide('window', window);
app.mount('#app');
