import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from './components/general/Login.vue';
import Register from './components/general/Register.vue';
import Dashboard from './components/kanban/Dashboard.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            component: Login
        },
        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            component: Register
        },
        { 
            path: '/dashboard',
            component: Dashboard
        }
    ],
    mode: 'history',
});