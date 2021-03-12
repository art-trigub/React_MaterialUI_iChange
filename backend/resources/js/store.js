import Vue from 'vue'
import Vuex from 'vuex';
import axios from 'axios'
import qs from 'qs'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        snack: {
            type : '', //success //fail
            msg   : ''
        }
    },

    mutations: {
        setSnack (state, snack) {
            state.snack = snack
        }
    },

    actions: {

    }
})
