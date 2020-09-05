import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

let routes = [
    {
        path:'/',
        component: require('./components/home').default
    }
];

export default new VueRouter({
    mode:'history',
    routes
});
