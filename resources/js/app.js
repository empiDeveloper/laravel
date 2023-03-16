require('./bootstrap');

// Init app
import { createApp } from 'vue';

// Import component
import HelloVue from '../components/index.vue';

// Imports Boostrap
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Mount
createApp({
    components: {
        HelloVue,
    }
}).mount('#app');
