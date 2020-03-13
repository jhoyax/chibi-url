import './bootstrap';
import Vue from 'vue';
import Routes from './routes.js';
import App from './App.vue';

new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App)
  });
