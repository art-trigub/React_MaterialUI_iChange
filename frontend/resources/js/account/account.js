import Vue from "vue"
// import Vuetify from 'vuetify'
// import 'material-design-icons-iconfont/dist/material-design-icons.css'
// import colors from "vuetify/es5/util/colors"
// import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
//
// Vue.use(Vuetify, {
//     iconfont: 'md',
//     theme: {
//         primary: '#5867dd', //colors.green.lighten1, // #E53935
//         secondary: colors.orange.lighten1, // #FFCDD2
//         accent: colors.orange.base // #3F51B5
//     }
// })

Vue.component('money-transfer', require('./components/MoneyTransfer'))
