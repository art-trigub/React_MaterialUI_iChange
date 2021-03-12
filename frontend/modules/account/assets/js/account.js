webpackJsonp([2],{

/***/ 79:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(80);


/***/ }),

/***/ 80:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue__);

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

__WEBPACK_IMPORTED_MODULE_0_vue___default.a.component('money-transfer', __webpack_require__(81));

/***/ }),

/***/ 81:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(82)
/* template */
var __vue_template__ = null
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/account/components/MoneyTransfer.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2061c992", Component.options)
  } else {
    hotAPI.reload("data-v-2061c992", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 82:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vee_validate__ = __webpack_require__(8);



var dict = {
    custom: {
        'MoneyTransferModel[agree]': {
            required: lajax.t('agree agree')
        },
        name: {
            required: function required() {
                return 'Your name is empty';
            }
        }
    }
};

/* harmony default export */ __webpack_exports__["default"] = ({
    inject: ['$validator'],
    data: function data() {
        return {
            submitLoading: false,
            countryLoading: false,
            transferTypeLoading: false,
            agentLoading: false,

            send_amount: 5000,
            send_currency: 'ILS',

            receive_amount: '',
            receive_currency: '',

            beneficiary_id: '',
            country_id: '',
            transfer_type_id: '',
            transfer_agent_id: '',

            maxReceiveAmount: {
                LOCAL: 0,
                EUR: 0,
                USD: 0
            },
            countryAgentCourse: {
                LOCAL: 0,
                EUR: 0,
                USD: 0
            },

            commissions: [],

            countryList: app.countryList,
            transferTypeList: {},
            transferAgentList: {},
            transferPickupBankList: {},

            receiveCurrencyNames: [],

            agree: false
        };
    },

    watch: {},

    created: function created() {
        var _this = this;

        this.$validator.extend('maxReceiveAmount', {
            getMessage: function getMessage(field) {
                return lajax.t('Max receive amount - ') + _this.maxReceiveAmountValue;
            },
            validate: function validate(value) {
                return parseFloat(value) <= parseFloat(_this.maxReceiveAmountValue);
            }
        });
    },
    mounted: function mounted() {
        var _this2 = this;

        this.$validator.localize('en', dict);

        this.agentSelect = $("#transfermoneyrequest-transfer_agent_id");
        this.agentSelect.on("change", function (e) {
            _this2.transfer_agent_id = e.target.value;
            _this2.changeTransferAgent();
        });
    },


    methods: {
        checkForm: function checkForm(e) {
            var _this3 = this;

            e.preventDefault();
            e.stopPropagation();
            this.submitLoading = true;
            var form = new FormData(e.srcElement);

            this.$validator.validateAll().then(function (result) {
                if (result) {
                    _this3.$http.post(_this3.langUrl('/account/money-transfers'), form).then(function (response) {
                        console.log(response);
                        if (response.data.status == 'OK') {
                            location.reload();
                        } else {
                            location.reload();
                        }

                        _this3.submitLoading = false;
                    }, function (e) {
                        console.error(e);
                        _this3.submitLoading = false;
                    });
                } else {
                    console.info(_this3.errors);
                }
            }).catch(function () {
                console.error('failed');
            });

            return false;
        },
        changeBeneficiary: function changeBeneficiary() {},
        changeCountry: function changeCountry() {
            var _this4 = this;

            //this.receive_currency = this.countryCurrency.name || 'USD';
            this.resetTransferData();

            this.countryLoading = true;
            this.$http.get(this.langUrl('/account/money-transfers/get-transfer-types'), {
                params: {
                    country_id: this.country_id
                }
            }).then(function (response) {
                _this4.transferTypeList = response.data;
                setTimeout(function () {
                    _this4.transfer_type_id = _this4.transfer_agent_id = '';

                    _this4.transferAgentList = {};
                }, 0);
                _this4.countryLoading = false;
            }, function (e) {
                _this4.countryLoading = false;
                console.error(e);
            });
        },
        changeTransferType: function changeTransferType() {
            var _this5 = this;

            this.resetTransferData();

            this.transferTypeLoading = true;
            this.$http.get(this.langUrl('/account/money-transfers/get-transfer-agents'), {
                params: {
                    country_id: this.country_id,
                    transfer_type_id: this.transfer_type_id
                }
            }).then(function (response) {
                _this5.transfer_agent_id = '';
                _this5.transferAgentList = response.data;
                setTimeout(function () {
                    var options = _this5.agentSelect.data('select2').options.options;
                    _this5.agentSelect.select2('destroy');
                    _this5.agentSelect.select2(options);
                }, 0);
                _this5.transferTypeLoading = false;
            }, function (e) {
                _this5.transferTypeLoading = false;
                console.error(e);
            });
        },
        changeTransferAgent: function changeTransferAgent() {
            var _this6 = this;

            this.resetTransferData();

            this.agentLoading = true;
            this.$http.get(this.langUrl('/account/money-transfers/get-amount-data'), {
                params: {
                    country_id: this.country_id,
                    transfer_type_id: this.transfer_type_id,
                    transfer_agent_id: this.transfer_agent_id
                }
            }).then(function (response) {
                console.log(response.data);

                _this6.maxReceiveAmount = response.data.maxAmount;
                _this6.commissions = response.data.commissions;
                _this6.countryAgentCourse = response.data.countryAgentCourse;
                _this6.receiveCurrencyNames = response.data.receiveCurrencyNames;

                _this6.$validator.validateAll(['TransferMoneyRequest[receive_amount]']);

                _this6.setReceiveCurrency();
                _this6.changeSendAmount();
                _this6.agentLoading = false;
            }, function (e) {
                _this6.agentLoading = false;
                console.error(e);
            });
        },
        setReceiveCurrency: function setReceiveCurrency() {
            this.receive_currency = this.receiveCurrencyNames[0];
        },
        resetTransferData: function resetTransferData() {
            this.resetMaxReceiveAmount();
            this.resetCountryAgentCourse();
            this.receiveCurrencyNames = [];
            this.receive_amount = '';
        },
        changeSendAmount: function changeSendAmount() {
            this.receive_amount = this.toFixed(this.transferCourse * this.send_amount);

            // if(this.receive_currency == this.countryCurrency.name) {
            //     let sendAmount   = this.send_amount;
            //     let sendCurrency = this.send_currency;
            //     if(this.send_currency == 'ILS') {
            //         sendCurrency = 'USD';
            //         sendAmount /= app.currencyList['USD'].crossrate;
            //     }
            //
            //     this.receive_amount = this.toFixed(this.countryAgentCourse[sendCurrency] * sendAmount);
            // } else {
            //     if (this.sendCurrency.crossrate && this.receiveCurrency.crossrate) {
            //         let k = this.sendCurrency.crossrate / this.receiveCurrency.crossrate;
            //         this.receive_amount = this.toFixed(k * this.send_amount)
            //     }
            // }
        },
        changeReceiveAmount: function changeReceiveAmount() {
            this.send_amount = this.toFixed(this.receive_amount / this.transferCourse);
            // if(this.receive_currency == this.countryCurrency.name) {
            //     let sendAmount   = this.send_amount;
            //     let sendCurrency = this.send_currency;
            //     if(this.send_currency == 'ILS') {
            //         sendCurrency = 'USD';
            //         this.send_amount = this.toFixed(this.receive_amount / this.countryAgentCourse[sendCurrency] * app.currencyList[sendCurrency].crossrate);
            //     } else {
            //         this.send_amount = this.toFixed(this.receive_amount / this.countryAgentCourse[sendCurrency]);
            //     }
            // } else {
            //     if(this.sendCurrency.crossrate && this.receiveCurrency.crossrate) {
            //         let k = this.sendCurrency.crossrate / this.receiveCurrency.crossrate;
            //         this.send_amount = this.toFixed(this.receive_amount / k)
            //     }
            // }
        },
        resetMaxReceiveAmount: function resetMaxReceiveAmount() {
            var _this7 = this;

            Object.keys(this.maxReceiveAmount).forEach(function (name) {
                _this7.maxReceiveAmount[name] = 0;
            });
        },
        resetCountryAgentCourse: function resetCountryAgentCourse() {
            var _this8 = this;

            Object.keys(this.countryAgentCourse).forEach(function (name) {
                _this8.countryAgentCourse[name] = 0;
            });
        },
        changeSendCurrency: function changeSendCurrency() {
            this.changeSendAmount();
        },
        changeReceiveCurrency: function changeReceiveCurrency() {
            this.changeSendAmount();
        }
    },

    computed: {
        transferCourse: function transferCourse() {
            if (this.receive_currency == this.countryCurrency.name) {
                if (this.send_currency == 'ILS') {
                    return this.countryAgentCourse['USD'] / app.currencyList['USD'].crossrate;
                }
                return this.countryAgentCourse[this.send_currency];
            } else {
                if (this.send_currency && this.receive_currency) {
                    return this.sendCurrency.crossrate / this.receiveCurrency.crossrate;
                }
            }

            return false;
        },
        sendCurrencyList: function sendCurrencyList() {
            var defaults = ['EUR', 'USD', 'ILS'];
            var result = {};
            defaults.forEach(function (name) {
                if (app.currencyList[name]) {
                    result[name] = app.currencyList[name];
                }
            });

            return result;
        },
        receiveCurrencyList: function receiveCurrencyList() {
            //receiveCurrencyNames
            var names = this.receiveCurrencyNames;
            var result = {};

            names.forEach(function (name) {
                if (app.currencyList[name]) {
                    result[name] = app.currencyList[name];
                }
            });

            return result;

            // if(this.country_id) {
            //     let list = {
            //         'EUR': app.currencyList['EUR'],
            //         'USD': app.currencyList['USD'],
            //     }
            //     let countryCurrency = app.countryList[this.country_id]['currency'];
            //     if(countryCurrency && app.currencyList[countryCurrency]) {
            //         list[countryCurrency] = app.currencyList[countryCurrency];
            //     }
            //     return list;
            // } else {
            //     return {};
            // }
        },
        countryCurrency: function countryCurrency() {
            if (this.country_id) {
                var countryCurrency = app.countryList[this.country_id]['currency'];
                return app.currencyList[countryCurrency] || {};
            }

            return {};
        },
        transferAgent: function transferAgent() {
            if (this.transfer_agent_id in this.transferAgentList) {
                return this.transferAgentList[this.transfer_agent_id];
            }
            return {};
        },
        transferType: function transferType() {
            if (this.transfer_type_id in this.transferTypeList) {
                return this.transferTypeList[this.transfer_type_id];
            }

            return {};
        },
        sendCurrency: function sendCurrency() {
            if (this.send_currency in this.sendCurrencyList) {
                return this.sendCurrencyList[this.send_currency];
            }
            return {};
        },
        receiveCurrency: function receiveCurrency() {
            if (this.receive_currency in this.receiveCurrencyList) {
                return this.receiveCurrencyList[this.receive_currency];
            }

            return {};
        },
        maxReceiveAmountValue: function maxReceiveAmountValue() {
            if (this.receive_currency) {
                if (this.maxReceiveAmount[this.receive_currency]) {
                    return this.maxReceiveAmount[this.receive_currency];
                } else {
                    return this.maxReceiveAmount['LOCAL'];
                }
            }

            return 0;
        },
        transferFee: function transferFee() {
            var result = 0;
            var sendAmount = this.send_amount;
            if (this.receive_amount) {
                if (this.send_currency == 'ILS') {
                    //to USD
                    sendAmount /= app.currencyList['USD'].crossrate;
                }

                for (var i in this.commissions) {
                    if (sendAmount >= this.commissions[i].dia_from && (sendAmount <= this.commissions[i].dia_to || !this.commissions[i].dia_to)) {
                        result = this.commissions[i].type == 'n' ? this.commissions[i].value : sendAmount * this.commissions[i].value / 100;

                        break;
                    }
                }
            }

            return result;
        },
        transferFeeConverted: function transferFeeConverted() {
            if (this.transferFee) {
                if (this.send_currency == 'ILS') {
                    return this.toFixed(this.transferFee * app.currencyList['USD'].crossrate);
                }

                return this.transferFee;
            }

            return 0;
        },
        totalToPay: function totalToPay() {
            var result = 0;
            if (this.receive_amount && this.send_amount) {
                var transferFee = parseFloat(this.transferFee);
                if (this.send_currency == 'ILS') {
                    transferFee = transferFee * app.currencyList['USD'].crossrate;console.log(transferFee);
                    result = parseFloat(this.send_amount) + transferFee;
                } else {
                    console.log(this.send_amount, transferFee, app.currencyList[this.send_currency].crossrate);
                    result = (this.send_amount + transferFee) * app.currencyList[this.send_currency].crossrate;
                }
            }

            return result;
        },
        isDataValid: function isDataValid() {}
    }
});

/***/ })

},[79]);