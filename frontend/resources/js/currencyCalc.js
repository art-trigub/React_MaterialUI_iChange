
import Vue from "vue"

Vue.component('currency-calc', {
    inject: ['$validator'],
    data:() => ({
        amount: {
            from: '',
            to: ''
        },
        currency      : '',
        crossrate     : '',
        CR_TO_ILS     : '',
        CR_ILS_TO     : '',
        multipleValue : '',
        amountModel   : '',
        volume        : null,

    }),

    mounted() {
        this.getCurrencyData();
    },

    created() {
        this.$validator.extend('amountModelMultiple', {
            getMessage: (field) => {
                return lajax.t('Enter amount in multiples of ') + this.multipleValue;
            },
            validate: (value) => {
                if(this.multipleValue) {
                    return this.amount['from'] % this.multipleValue === 0;
                }
            }
        });
    },

    methods: {
        getCurrencyData() {
            let selectedOption = this.$refs.currency.selectedOptions[0];
            if(selectedOption) {
                this.CR_TO_ILS = selectedOption.getAttribute('data-cr');
                this.CR_ILS_TO = selectedOption.getAttribute('data-cr-inverted');

                this.currency = selectedOption.getAttribute('data-currency');
                this.multipleValue = selectedOption.getAttribute('data-multiple-value');
                this.volume = selectedOption.getAttribute('data-volume') || 1;
            }
        },

        async validateData() {
            await this.$validator.validateAll(['CurrencyOrder[amount]']);
        },

        doConvert(dir) {
            switch(dir) {
                case 'from': {
                    this.amount['to'] = this.toFixed((this.CR_TO_ILS / this.volume) * this.amount['from']);
                } break;
                case 'to': {
                    this.amount['from'] = this.toFixed(this.amount['to'] / (this.CR_TO_ILS  / this.volume));
                }
            }
        },

        changeCurrency(event) {
            this.getCurrencyData();
            this.doConvert('from');
        },

        checkForm(e) {
            this.$validator.validateAll()
                .then((result) => {
                    setTimeout(() => {
                        if(result && $(e.target).yiiActiveForm('data').validated) {
                            e.target.submit();
                        }
                    }, 500);


                })
                .catch((err) => {
                    console.error(err)
                });
        }
    },

    computed: {
        total() {
            return (this.amountModel * this.CR_TO_ILS).toFixed(3).slice(0, -1);
        }
    }
});
