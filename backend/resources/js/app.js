
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('currency-assets', require('./components/CurrencyAssets'))

Vue.component('related-news', require('./components/RelatedNews'))

Vue.component('card-params', require('./components/CardParams'))

Vue.component('transfer-money', require('./components/TransferMoney'))

Vue.component('transfer-money-commission', require('./components/TransferMoneyCommission'))

Vue.component('transfer-country-agent', require('./components/TransferCountryAgent'))

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import store from './store'
import VueAxios from 'vue-axios'
import Vuetify from 'vuetify'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
//import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
import '../../web/css/vuetify.css'
import colors from 'vuetify/es5/util/colors'
import Sortable from 'vue-sortable'

Vue.use(Sortable)
Vue.use(VueAxios, axios)
Vue.use(VueRouter)
Vue.use(Vuetify, {
    iconfont: 'md',
    theme: {
        primary: '#5867dd', //colors.green.lighten1, // #E53935
        secondary: colors.orange.lighten1, // #FFCDD2
        accent: colors.orange.base // #3F51B5
    }
})

const router = new VueRouter({
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    router,
    store
});
