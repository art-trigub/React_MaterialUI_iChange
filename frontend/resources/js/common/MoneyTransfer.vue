<script>
    import VeeValidate from 'vee-validate';

    const dict = {
        custom: {
            'MoneyTransferModel[agree]': {
                required: lajax.t('agree agree')
            },
            name: {
                required: () => 'Your name is empty'
            }
        }
    };

    export default {
        inject: ['$validator'],
        data: () => ({

            firstStep: true,

            submitLoading: false,
            countryLoading: false,
            transferTypeLoading: false,
            agentLoading: false,

            send_amount: 1,
            send_currency: null,
            sendCurrencyNames: [],

            receive_amount: '',
            receive_currency: '',

            beneficiary_id: '',

            country_id: '',
            transfer_type_id: '',
            transfer_agent_id: '',

            sender_citizenship: '',
            receiver_country: '',

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

            agree: false,

            allowNextStep: false,
        }),

        created() {
            this.$validator.extend('maxReceiveAmount', {
                getMessage: (field) => {
                    return lajax.t('Max receive amount - ') + this.maxReceiveAmountValue;
                },
                validate: (value) => {
                    if (this.maxReceiveAmountValue) {
                        return parseFloat(value) <= parseFloat(this.maxReceiveAmountValue);
                    }
                    return true;
                }
            });
        },

        mounted() {
            this.$validator.localize('en', dict);

            this.agentSelect = $("#transfer-agent");
            this.agentSelect.on("change", (e) => {
                this.transfer_agent_id = e.target.value;
                this.changeTransferAgent();
            });
        },

        watch: {
            sender_citizenship() {
                this.receiver_country = this.sender_citizenship
            }
        },

        methods: {

            checkForm(e) {
                e.preventDefault();
                e.stopPropagation();
                this.submitLoading = true;
                let form = new FormData(e.srcElement);

                this.$validator.validateAll()
                    .then((result) => {
                        console.log(this.$validator, result, 'result');
                        if (result) {
                            e.target.submit();
                        }
                    })
                    .catch(() => {
                        console.error('failed')
                    });

                return false;
            },

            changeCountry() {
                this.resetTransferData();

                this.countryLoading = true;
                this.$http.get(this.langUrl('/money-transfer/get-transfer-types'), {
                    params: {
                        country_id: this.country_id
                    }
                }).then((response) => {
                    this.transferTypeList = response.data;
                    setTimeout(() => {
                        this.transfer_type_id =
                            this.transfer_agent_id = '';

                        this.transferAgentList = {};
                    }, 0);
                    this.countryLoading = false;
                }, (e) => {
                    this.countryLoading = false;
                    console.error(e);
                })
            },

            changeTransferType() {
                this.resetTransferData();

                this.transferTypeLoading = true;
                this.$http.get(this.langUrl('/money-transfer/get-transfer-agents'), {
                    params: {
                        country_id: this.country_id,
                        transfer_type_id: this.transfer_type_id
                    }
                }).then((response) => {
                    this.transfer_agent_id = '';
                    this.transferAgentList = response.data;
                    setTimeout(() => {
                        let options = this.agentSelect.data('select2').options.options;
                        this.agentSelect.select2('destroy');
                        this.agentSelect.select2(options);
                    }, 0);
                    this.transferTypeLoading = false;
                }, (e) => {
                    this.transferTypeLoading = false;
                    console.error(e);
                })
            },

            changeTransferAgent() {
                this.resetTransferData();

                this.agentLoading = true;
                this.$http.get(this.langUrl('/money-transfer/get-amount-data'), {
                    params: {
                        country_id: this.country_id,
                        transfer_type_id: this.transfer_type_id,
                        transfer_agent_id: this.transfer_agent_id
                    }
                }).then((response) => {
                    console.log(response.data);

                    this.maxReceiveAmount = response.data.maxAmount;
                    this.commissions = response.data.commissions;
                    this.countryAgentCourse = response.data.countryAgentCourse;
                    this.receiveCurrencyNames = response.data.receiveCurrencyNames;
                    this.sendCurrencyNames = response.data.sendCurrencyNames;
                    this.send_currency = response.data.sendCurrencyNames[0] || '';

                    this.$validator.validateAll(['MoneyTransferForm[receive_amount]']);
                    this.setReceiveCurrency();
                    this.changeSendAmount()
                    this.agentLoading = false;
                }, (e) => {
                    this.agentLoading = false;
                    console.error(e);
                })
            },

            setReceiveCurrency() {
                this.receive_currency = this.receiveCurrencyNames[0]
            },

            resetTransferData() {
                this.resetMaxReceiveAmount();
                this.resetCountryAgentCourse();
                this.receiveCurrencyNames = [];
                this.receive_amount = '';
            },

            changeSendAmount() {
                this.receive_amount = this.toFixed(this.transferCourse * this.send_amount);
            },

            changeReceiveAmount() {
                this.send_amount = this.toFixed(this.receive_amount / this.transferCourse);
            },

            resetMaxReceiveAmount() {
                Object.keys(this.maxReceiveAmount).forEach((name) => {
                    this.maxReceiveAmount[name] = 0;
                })
            },

            resetCountryAgentCourse() {
                Object.keys(this.countryAgentCourse).forEach((name) => {
                    this.countryAgentCourse[name] = 0;
                })
            },

            changeSendCurrency() {
                this.changeSendAmount()
            },

            changeReceiveCurrency() {
                this.changeSendAmount()
            },

            async checkNextStep() {

                this.allowNextStep = await this.$validator.validateAll([
                    'MoneyTransferForm[send_amount]',
                    'MoneyTransferForm[send_currency]',
                    'MoneyTransferForm[receive_amount]',
                    'MoneyTransferForm[receive_currency]',
                    'MoneyTransferForm[country_id]',
                    'MoneyTransferForm[transfer_type_id]',
                    'MoneyTransferForm[transfer_agent_id]',
                ]).then(result => result);

                this.firstStep = !this.allowNextStep;
            },
        },

        computed: {

            sortedCountryList() {
                let sortable = [];
                for(let key in this.countryList) {
                    if (this.countryList.hasOwnProperty(key)) {
                        sortable.push([key, this.countryList[key].name]); // each item is an array in format [key, value]
                    }
                }

                // sort items by value
                sortable.sort((a, b) => {
                    let x=a[1].toLowerCase(),
                        y=b[1].toLowerCase();
                    return x<y ? -1 : x>y ? 1 : 0;
                });

                return sortable;
            },

            transferCourse() {
                if (this.receive_currency == this.countryCurrency.name) {
                    if (this.send_currency == 'ILS') {
                        return this.countryAgentCourse['USD'] / app.currencyList['USD'].crossrate;
                    }
                    return this.countryAgentCourse[this.send_currency];
                } else if (this.send_currency) {
                    if (this.send_currency && this.receive_currency) {
                        return this.sendCurrency.crossrate / this.receiveCurrency.crossrate
                    }
                }

                return false;
            },

            crossCourseRate() {
                if (this.send_currency && this.send_currency !== 'ILS') {
                    console.log('---');
                    return app.currencyList[this.send_currency].crossrate;
                }
                return null;
            },

            sendCurrencyList() {
                let defaults = ['EUR', 'USD', 'ILS'];
                let result = {};
                this.sendCurrencyNames.forEach((name) => {
                    if (app.currencyList[name]) {
                        result[name] = app.currencyList[name];
                    }
                });

                return result;
            },

            receiveCurrencyList() {
                //receiveCurrencyNames
                let names = this.receiveCurrencyNames;
                let result = {};

                names.forEach((name) => {
                    if (app.currencyList[name]) {
                        result[name] = app.currencyList[name];
                    }
                });

                return result;
            },

            countryCurrency() {
                if (this.country_id) {
                    let countryCurrency = app.countryList[this.country_id]['currency'];
                    return app.currencyList[countryCurrency] || {};
                }

                return {};
            },

            transferAgent() {
                if (this.transfer_agent_id in this.transferAgentList) {
                    return this.transferAgentList[this.transfer_agent_id];
                }
                return {};
            },

            transferType() {
                if (this.transfer_type_id in this.transferTypeList) {
                    return this.transferTypeList[this.transfer_type_id];
                }

                return {};
            },

            sendCurrency() {
                if (this.send_currency in this.sendCurrencyList) {
                    return this.sendCurrencyList[this.send_currency];
                }
                return {};
            },

            receiveCurrency() {
                if (this.receive_currency in this.receiveCurrencyList) {
                    return this.receiveCurrencyList[this.receive_currency];
                }

                return {};
            },

            maxReceiveAmountValue() {
                if (this.receive_currency) {
                    if (this.maxReceiveAmount[this.receive_currency]) {
                        return this.maxReceiveAmount[this.receive_currency];
                    } else {
                        return this.maxReceiveAmount['LOCAL'];
                    }
                }

                return 0;
            },

            transferFee() {
                let result = 0;
                let sendAmount = this.send_amount;
                if (this.receive_amount) {
                    if (this.send_currency == 'ILS') { //to USD
                        sendAmount /= app.currencyList['USD'].crossrate;
                    }

                    for (var i in this.commissions) {
                        if (sendAmount >= this.commissions[i].dia_from && (sendAmount <= this.commissions[i].dia_to || !this.commissions[i].dia_to)) {
                            result = this.commissions[i].type == 'n' ?
                                this.commissions[i].value :
                                sendAmount * this.commissions[i].value / 100;

                            break;
                        }
                    }
                }

                return result;
            },

            transferFeeConverted() {
                if (this.transferFee) {
                    if (this.send_currency == 'ILS') {
                        return this.toFixed(this.transferFee * app.currencyList['USD'].crossrate);
                    }

                    return this.transferFee;
                }

                return 0;
            },

            totalToPay() {
                let result = 0;
                if (this.receive_amount && this.send_amount) {
                    let transferFee = parseFloat(this.transferFee);
                    if (this.send_currency == 'ILS') {
                        transferFee = transferFee * app.currencyList['USD'].crossrate;
                        console.log(transferFee);
                        result = parseFloat(this.send_amount) + transferFee;
                    } else if (this.send_currency) {
                        console.log(this.send_amount, transferFee, app.currencyList[this.send_currency].crossrate);
                        result = (this.send_amount + transferFee) * app.currencyList[this.send_currency].crossrate
                    }
                }

                return result;
            },

            isDataValid() {

            }
        }
    }
</script>
