/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from "vue";

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
import moment from 'moment';
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios,axios);
window.Vue.use(VueRouter)
window.Vue.filter('date', function (created) {
    return moment(created).format('MMMM Do YYYY, h:mm:ss a');
})
import Department from './components/department/Department'
// Reception components
import Reception from './components/reception/Reception'
// import Patient from './components/reception/Patient'
import Report from './components/department/Report'
//
import DepartmentQueue from './components/department/DepartmentQueue'
import Referral from './components/department/Referral'
import DepartmentNotes from './components/department/DepartmentNotes'

const routes = [
    {
        path: '/reception',
        component: Reception,

    },
    {
        path: '/:department',
        component: Department,
        children: [{
            name: 'depQueue',
            path: 'queue',
            component: DepartmentQueue
        },
            {
                name: 'showReports',
                path: 'reports',
                component: Report
            },
            {
                name: 'notes',
                path: 'notes/:patientID/:patientName',
                component: DepartmentNotes
            },
            {
                name: "showReferrals",
                path: 'myreferrals',
                component: Referral
            },

        ]
    }, {
        path: '*',
        redirect: {
            name: 'depQueue'
        }
    }
]
const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
