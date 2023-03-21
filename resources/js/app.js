require('./bootstrap');

// Init app
import { createApp } from 'vue';
import router from '../routes/index';

// Import component
import AppVue from '../components/App.vue';

// Imports Boostrap
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap-vue/dist/bootstrap-vue.js'

// Mount
const app = createApp({});
app.component('App', AppVue);
app.use(router);
app.mount('#app');
