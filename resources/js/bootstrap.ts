(window as any)._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

(window as any).axios = require('axios');
(window as any).axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
