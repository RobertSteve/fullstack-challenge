import Vue from 'vue';
import router from './router';
import App from './components/App.vue';
import store from './store';

require('./bootstrap');

const app = new Vue({
    el: '#app',
    router,
    components: {
        App
    },
    store
});