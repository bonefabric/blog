require('./bootstrap');
window.Vue = require('vue').default;

import Application from "./components/Application";

new Vue({
    el: '#app',
    render: h => h(Application)
});
