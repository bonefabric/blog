require('./bootstrap');
import {createApp} from "vue";

import Application from "./components/Application";

import router from "./router";
import {key, store} from "./store";

createApp(Application)
    .use(store, key)
    .use(router)
    .mount('#app');
