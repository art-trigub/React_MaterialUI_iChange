<template>
    <v-app>
        <snackbar></snackbar>

    <form ref="form"
            onsubmit="return false;"
            action="/currency/assets/save"
            method="post"
            novalidate="true"
    >
    <div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
        <div class="assets m-portlet__head" uk-sticky="offset: 70">
            <div class="assets__header assets__row m-alert m-alert--air m-alert--square alert">
                <div class="assets-header__cell assets__cell assets__cell-icon">Icon</div>
                <div class="assets-header__cell assets__cell assets__cell-name">
                    <div class="assets-header__cell_title">Name</div>
                    <div class="assets-header__cell_sub">
                        <input class="form-control m-input name" type="text" placeholder="Search Name" v-model="searchName">
                    </div>
                </div>

                <div class="assets-header__cell assets__cell assets__cell-cash_1">
                    <div class="assets-header__cell_title">Cash 0-500</div>
                    <div class="assets-header__cell_sub">
                        <div class="assets__cell">Buy</div>
                        <div class="assets__cell">Sell</div>
                    </div>
                </div>
                <div class="assets-header__cell assets__cell assets__cell-cash_2">
                    <div class="assets-header__cell_title">Cash +500</div>
                    <div class="assets-header__cell_sub">
                        <div class="assets__cell assets__cell-buy">Buy</div>
                        <div class="assets__cell assets__cell-sell">Sell</div>
                    </div>
                </div>

                <div class="assets-header__cell assets__cell assets__cell-debit_c">Debit</div>
                <div class="assets-header__cell assets__cell assets__cell-credit_c">Credit</div>

                <div class="assets-header__cell assets__cell assets__cell-middle_c">Middle</div>
                <div class="assets-header__cell assets__cell assets__cell-volume">Volume</div>

                <div class="assets-header__cell assets__cell assets__cell-transfer">Transfer</div>
                <div class="assets-header__cell assets__cell assets__cell-remove"></div>
            </div>
        </div>

        <div class="m-portlet__body">
            <v-progress-linear v-if="loading" color="info" :indeterminate="true"></v-progress-linear>
            <draggable v-model="filteredData" tag="div" class="assets__body">
                    <div class="assets__row m-alert m-alert--air m-alert--square alert" v-for="(item, i) in filteredData" :id="'row-' + i" v-show="item.show">
                        <input type="hidden" :name="'Currency[' + i + '][currency_id]'" :value="item.currency_id"/>
                        <div class="assets__cell assets__cell-icon">
                            <v-select style="margin:0"
                                    :hide-details="true"
                                    :items="icons"
                                    ref="Icon"
                                    v-model="item.icon"
                                    label="Icon"
                            >
                                <template slot="item" slot-scope="{ item, index }">
                                    <v-avatar
                                            :tile="false"
                                            :size="35"
                                            color="grey lighten-4"
                                    >
                                        <img :src="item.imagePath"/>
                                    </v-avatar>
                                </template>
                                <template slot="selection" slot-scope="{ item, index }">
                                    <input type="hidden" :value="item.currency_icon_id" :name="'Currency[' + i + '][currency_icon_id]'"/>
                                    <input type="hidden" :value="item.imagePath" :name="'Currency[' + i + '][icon_path]'"/>
                                    <input type="hidden" :value="item.image" :name="'Currency[' + i + '][icon]'"/>
                                    <v-avatar
                                            :tile="false"
                                            :size="30"
                                            color="grey lighten-4"
                                    >
                                        <img :src="item.imagePath"/>
                                    </v-avatar>
                                </template>
                            </v-select>
                        </div>
                        <div class="assets__cell assets__cell-name" v-model="item.name">
                            <input class="form-control m-input name" @keyup.enter="onSubmit" type="text" v-model="item.name" :name="'Currency[' + i + '][name]'">
                        </div>

                        <div class="assets__cell assets__cell-buy">
                            <input class="form-control m-input buy_1" @keyup.enter="onSubmit" type="text" v-model="item.buy_1" :name="'Currency[' + i + '][buy_1]'">
                        </div>
                        <div class="assets__cell assets__cell-sell">
                            <input class="form-control m-input sell_1" @keyup.enter="onSubmit" type="text" v-model="item.sell_1" :name="'Currency[' + i + '][sell_1]'">
                        </div>


                        <div class="assets__cell assets__cell-buy">
                            <input class="form-control m-input buy_2" @keyup.enter="onSubmit" type="text" v-model="item.buy_2" :name="'Currency[' + i + '][buy_2]'">
                        </div>
                        <div class="assets__cell assets__cell-sell">
                            <input class="form-control m-input sell_2" @keyup.enter="onSubmit" type="text" v-model="item.sell_2" :name="'Currency[' + i + '][sell_2]'">
                        </div>

                        <div class="assets__cell assets__cell-debit_c">
                            <input class="form-control m-input debit" @keyup.enter="onSubmit" type="text" v-model="item.debit" :name="'Currency[' + i + '][debit]'">
                        </div>
                        <div class="assets__cell assets__cell-credit_c">
                            <input class="form-control m-input credit" @keyup.enter="onSubmit" type="text" v-model="item.credit" :name="'Currency[' + i + '][credit]'">
                        </div>

                        <div class="assets__cell assets__cell-middle_c">
                            <input class="form-control m-input middle" @keyup.enter="onSubmit" type="text" v-model="item.middle" :name="'Currency[' + i + '][middle]'">
                        </div>
                        <div class="assets__cell assets__cell-volume">
                            <input class="form-control m-input volume" @keyup.enter="onSubmit" type="text" v-model="item.volume" :name="'Currency[' + i + '][volume]'">
                        </div>


                        <div class="assets__cell assets__cell-transfer">
                            <input class="form-control m-input transfer" @keyup.enter="onSubmit" type="text" v-model="item.transfer" :name="'Currency[' + i + '][transfer]'">
                        </div>


                        <div class="assets__cell assets__cell-remove">
                            <v-btn icon color="red" @click="remove(i)">
                                <v-icon color="white">delete</v-icon>
                            </v-btn>
                        </div>

                    </div>
            </draggable>
        </div>
        <div class="m-portlet__foot">
            <div class="row align-items-center">
                <div class="col-lg-6 m--valign-middle">
                    <button type="button" class="btn btn-link" @click="addNew"><i class="flaticon-plus"></i> Add new currency</button>
                </div>
                <div class="col-lg-6 m--align-right">
                    <v-btn type="button" @click="saveForm($event)" color="success" :loading="saveLoading">Save</v-btn>
                </div>
            </div>
        </div>
    </div>
    </form>
    </v-app>
</template>

<script>
    import draggable from 'vuedraggable'
    import snackbar from './Snackbar'
    import Vue from 'vue';

    export default {
        data() {
            return {
                loading: false,
                saveLoading: false,
                icons: [],
                items: [],

                searchName: null,
                formData: null,
            }
        },

        components: {
            draggable, snackbar
        },

        created() {
            this.loading = true;
            this.$http.get('/currency/assets/get-all').then((response) => {
                this.icons = response.data.icons;
                this.items = response.data.items.map(item => Object.assign(item, { show: true }));
                this.loading = false;
            }, e => {
                this.loading = false;
                console.error(e);
            });
        },

      computed: {
        filteredData() {
            let items = this.items;
            if (this.searchName) {
              items.forEach((item) => {
                item.name.toLowerCase().includes(this.searchName.toLowerCase()) ? item.show = true : item.show = false;
              });
            } else {
              items.forEach((item) =>  item.show = true);
            }
            return items;
          }
      },

        methods: {

            saveForm(e) {
                this.saveLoading = true;
                let form = new FormData(this.$refs.form);
                this.$http.post('/currency/assets/save', form).then((response) => {
                    console.log(response);
                    if(response.data.status == 'OK') {
                        this.$store.commit('setSnack', {
                            type : 'success',
                            msg  : 'Data saved'
                        });
                    } else {
                        this.$store.commit('setSnack', {
                            type : 'fail',
                            msg  : response.data.errors
                        });
                    }

                    this.saveLoading = false;
                }, e => {
                    console.error(e);
                    this.saveLoading = false;
                });
            },

            onSubmit(event) {
                event.preventDefault()
                event.stopPropagation()
                console.log(event)

                let name = event.target.name;
                let parts = name.match(/Currency\[([\d]+)\]\[([^\]]+)\]/)

                if(parts) {
                    let input = document.getElementById("row-" + (parseInt(parts[1]) + 1)).getElementsByClassName(parts[2]);
                    console.log(input[0]);
                    if(input) {
                        input[0].focus();
                        input[0].select()
                    }
                }
            },

            addNew() {
                this.items.push({});
            },

            remove(index) {
                this.items.splice(index, 1);
            }
        }
    }
</script>


<style lang="scss" scoped>
    .assets-list{
        list-style:none; margin:0px; padding:0px;

        &__item{
            display:block; height:40px; line-height:40px; background:red;
            margin-bottom:10px;
        }
    }
    .assets.m-portlet__head{
        height: auto; z-index:9; background:#FFF;
    }
    .assets__header{
        width:100%; display:flex; margin-top:15px; font-weight:bold;
        align-items: center;
    }
    .assets__cell-cash_1,
    .assets__cell-cash_2 {
        display:flex; flex-direction: column;
        padding: 5px 0 5px 0 !important;
    }
    .assets__cell-cash_1{
        background-color: #f0f0f099;
    }
    .assets__cell-cash_2{
        background-color: #f0f0f099;
    }

    .assets-header__cell_sub{
        display:flex;
    }
    .assets-header__cell_title{
        margin-bottom:10px;
    }
    .assets-header__cell_sub .assets__cell{
        flex: 0 0 50%;
    }
    .assets__row{
        display:flex;
    }
    .assets__cell{
        padding:0 10px; text-align:center;
    }
    .assets__cell-icon{
        flex:0 0 80px;
    }
    .assets__cell-name,
    .assets__cell-credit_c,
    .assets__cell-debit_c,
    .assets__cell-middle_c{
        flex:0 0 8%;
    }
    .assets__cell-cash_1,
    .assets__cell-cash_2{
        flex:0 0 19.6%;
    }
    .assets__cell-buy,
    .assets__cell-sell,
    .assets__cell-middle,
    .assets__cell-credit,
    .assets__cell-debit,
    .assets__cell-volume,
    .assets__cell-transfer{
        flex:0 0 10%;
    }
    .assets__cell.assets__cell-remove{
        flex:0 0 60px;
    }
</style>
