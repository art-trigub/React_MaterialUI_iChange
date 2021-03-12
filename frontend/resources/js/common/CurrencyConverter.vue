<template>
    <div class="currency__calc">
        <p class="currency__title">{{t('app', 'Currency converter')}}</p>
        <div class="currency__wrap">
            <p class="currency__text">{{t('app', 'I-CHANGE rates')}}</p>
        </div>

        <div class="calc">
            <ul class="calc__table">
                <li class="calc__col">
                    <div class="calc__th">{{t('app', 'Currency')}}</div>
                    <div class="calc__wrap">
                        <div class="calc__td">
                            <div class="calc__select">
                                <select v-model="assetModel['from']">
                                    <option v-for="asset in assets" :value="asset">{{asset}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="calc__td">
                            <button class="btn btn_exchange" type="button" @click="reverse()">
                                <svg class="icon" width="18" height="18">
                                    <use xlink:href="#icon-exchange"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="calc__td">
                            <div class="calc__select">
                                <select v-model="assetModel['to']">
                                    <option v-for="asset in assets" :value="asset">{{asset}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="calc__col">
                    <div class="calc__th">{{t('app', 'Amount')}}</div>
                    <div class="calc__wrap">
                        <div class="calc__td">
                            <input v-model="volumeModel['from']" @input="changeValue('from')" type="number" min="0"
                                   value="1000" oninput="validity.valid||(value='');">
                        </div>
                        <div class="calc__td"></div>
                        <div class="calc__td">
                            <input v-model="volumeModel['to']" @input="changeValue('to')" type="number" min="0"
                                   value="1000" oninput="validity.valid||(value='');">
                        </div>
                    </div>
                </li>
                <li class="calc__col">
                    <div class="calc__th">{{t('app', 'Buy')}}</div>
                    <div class="calc__wrap">
                        <div class="calc__td">
                            <small class="uk-text-muted uk-text-normal" v-if="crossRates[assetModel['from']]['volume']">
                                {{crossRates[assetModel['from']]['volume']}} {{assetModel['from']}} for
                            </small>
                            <span>{{assetModel.from === 'ILS' ? '' : toFixed(crossRates[assetModel['from']][buyType])}}</span>
                        </div>
                        <div class="calc__td"></div>
                        <div class="calc__td">
                            <small class="uk-text-muted uk-text-normal" v-if="crossRates[assetModel['to']]['volume']">
                                {{crossRates[assetModel['to']]['volume']}} {{assetModel['to']}} for
                            </small>
                            <span>{{assetModel.to === 'ILS' ? '' : toFixed(crossRates[assetModel['to']].buy_1_result)}}</span>
                        </div>
                    </div>
                </li>
                <li class="calc__col">
                    <div class="calc__th">{{t('app', 'Sell')}}</div>
                    <div class="calc__wrap">
                        <div class="calc__td">
                            <small class="uk-text-muted uk-text-normal" v-if="crossRates[assetModel['from']]['volume']">
                            </small>
                            <span>{{assetModel.from === 'ILS' ? '' : toFixed(crossRates[assetModel['from']].sell_1_result)}}</span>

                        </div>
                        <div class="calc__td"></div>
                        <div class="calc__td">
                            <small class="uk-text-muted uk-text-normal" v-if="crossRates[assetModel['to']]['volume']">
                                {{crossRates[assetModel['to']]['volume']}} {{assetModel['to']}} for
                            </small>
                            <span>{{assetModel.to === 'ILS' ? '' : toFixed(crossRates[assetModel['to']][sellType])}}</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <a :href="langUrl('/currencies/order')" class="btn btn_green">{{t('app', 'Order currency')}}</a>

    </div>
</template>

<script>
  export default {
    data() {
      return {
        assetModel: {
          from: 'ILS',
          to: 'USD',
        },
        volumeModel: {
          from: 1,
          to: '',
        },
        sellType: 'sell_1_result',
        crossRates: Object.assign({
          "ILS": {
            "name": "ILS",
            "sell_1_result": 1,
            "sell_2_result": 1,
            "buy_1_result": 1,
            "buy_2_result": 1,
            "credit": 1,
            "debit": 1,
            "middle": 1,
            "volume": null
          },
        }, app.crossRates),

        differentRateFor: ['USD', 'EUR'],
      }
    },

    watch: {
      assetModel: {
        handler(model) {
          setTimeout(() => {
            this.volumeModel['to'] = this.resultValue();
          }, 0);
        },
        deep: true
      }
    },

    computed: {
      assets() {
        return Object.keys(this.crossRates);
      },
      rateType() {
        return {
          'from': this.differentRateFor.includes(this.assetModel['from']),
          'to': this.differentRateFor.includes(this.assetModel['to']),
        }
      },
      buyType() {
        return this.volumeModel['from'] > 499 && this.differentRateFor.includes(this.assetModel['from']) ? 'buy_2_result' : 'buy_1_result';
      },
    },

    created() {
      this.changeValue('from');
    },

    methods: {
      changeValue(dir) {

        switch (dir) {
          case 'from': {
            this.volumeModel['to'] = this.resultValue();
          }
            break;
          case 'to': {
            this.sellType = 'sell_1_result';
            if (this.volumeModel['to'] > 499 && this.differentRateFor.includes(this.assetModel['to'])) {
              console.log(this.volumeModel['to']);

              this.sellType = 'sell_2_result';
            }

            this.volumeModel['from'] = this.toFixed(this.volumeModel['to'] / this.ratio(this.sellType));
          }
        }
      },

      resultValue() {
        let result = this.toFixed(this.ratio() * this.volumeModel['from']);
        this.sellType = 'sell_1_result';

        if (this.differentRateFor.includes(this.assetModel['to'])) {
          let result2 = this.toFixed(this.ratio('sell_2_result') * this.volumeModel['from']);

          if (result2 > 499) {
            result = result2;
            this.sellType = 'sell_2_result';
          }
        }
        return result;
      },

      ratio(sellType = 'sell_1_result') {
        const fromVolume = this.crossRates[this.assetModel['from']].volume ? this.crossRates[this.assetModel['from']].volume : 1;
        const toVolume = this.crossRates[this.assetModel['to']].volume ? this.crossRates[this.assetModel['to']].volume : 1;
        return (this.crossRates[this.assetModel['from']][this.buyType] / fromVolume) / (this.crossRates[this.assetModel['to']][sellType] / toVolume);
      },

      reverse() {
        let temp = this.assetModel['from'];
        this.assetModel['from'] = this.assetModel['to'];
        this.assetModel['to'] = temp;
      },

      toFixed(value) {
        return parseFloat(value).toFixed(3).slice(0, -1);
      },
    }
  }
</script>
