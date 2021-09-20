require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

// import Vue from 'vue';
import App from './views/App';
import router from './router.js';

const app = new Vue({
  el:'#root',
  render: h => h(App),
  router //senza questo vue non trova router
});
