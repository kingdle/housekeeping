require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import router from './routes';
import jwtToken from './helpers/jwt';
import store from './store/index';
import App from './components/App';
import axios from 'axios';
import VueAxios from 'vue-axios';
// import moment from 'moment';
// import VueMoment from 'vue-moment';
// import ElementUI from 'element-ui';
// import 'element-ui/lib/theme-chalk/index.css';


import zh_CN from './locale/zh_CN';
import VeeValidate, {Validator} from 'vee-validate';

axios.interceptors.request.use(function (config) {
    if (jwtToken.getToken()) {
        config.headers['Authorization'] = 'Bearer ' + jwtToken.getToken();
    }
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});
Validator.localize('zh_CN', zh_CN);
Vue.use(VueRouter);
Vue.use(VeeValidate);
Vue.use(VueAxios, axios)
// Vue.use(ElementUI);

// require('moment/locale/zh-cn')
// Vue.use(VueMoment, {
//     moment
// })

Vue.component('app',App);

new Vue({
    el: '#app',
    router,
   	store
});
