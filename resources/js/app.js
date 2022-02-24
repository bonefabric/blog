require('./bootstrap');
import {createApp} from "vue";

import Application from "./components/Application";

import router from "./router";
import store from "./store";

createApp(Application)
    .use(router, store)
    .mount('#app');
