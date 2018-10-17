
window._ = require('lodash');

try {
    // window.$ = window.jQuery = require('jquery');

    // require('bootstrap');
    // require('./select2.min');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
