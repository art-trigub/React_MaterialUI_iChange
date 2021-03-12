require('./bootstrap')

import Vue from "vue"
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import store from './store'
import baseMix from './baseMix'
import {mapState} from "vuex"
import Locale from './plugins/Locale'
import translates from './translates'
import VeeValidate from 'vee-validate';

Vue.component('page-useful', require('./common/PageUseful'))
Vue.component('call-me-button', require('./common/CallMeButton'))
Vue.component('copy-link', require('./common/CopyLink'))
Vue.component('currency-converter', require('./common/CurrencyConverter'))
Vue.component('subscription', require('./common/Subscription'))
Vue.component('money-transfer', require('./common/MoneyTransfer'))

Vue.use(VeeValidate, {
    useConstraintAttrs: false,
    classes: true,
    classNames: {
        valid: 'is-valid',
        invalid: 'is-invalid'
    }
});
Vue.mixin(baseMix)
Vue.use(VueAxios, axios)
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history'
});

let fileLocale = document.currentScript.src.split("locale=")[1]
Vue.use(Locale, {
    language   : fileLocale,
    translates : translates
})

const vueapp = new Vue({
    el: '#app',
    data() {
        return {

        }
    },
    mixins: [baseMix],

    router,
    store
})
