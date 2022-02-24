require('./bootstrap');
import {createApp} from "vue";

import Application from "./components/Application";

import router from "./router";

createApp(Application)
    .use(router)
    .mount('#app');
