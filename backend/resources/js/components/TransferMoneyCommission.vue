<template>
    <v-app color="white">


        <snackbar></snackbar>
        <form ref="form"
              @submit="checkForm"
              action="/transfer-money-matrix/save-commission"
              method="post"
              novalidate="true">

            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Dia From</th>
                    <th>Dia To</th>
                    <th>Value</th>
                    <th>Type</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in list">
                    <th scope="row">
                        <input type="hidden" :value="item.transfer_money_commission_id" :name="'commission['+index+'][transfer_money_commission_id]'"/>
                    </th>
                    <td><v-text-field v-model="item.dia_from" :name="'commission['+index+'][dia_from]'" label="Regular"></v-text-field></td>
                    <td><v-text-field v-model="item.dia_to" :name="'commission['+index+'][dia_to]'" label="Regular"></v-text-field></td>
                    <td><v-text-field v-model="item.value" :name="'commission['+index+'][value]'" label="Regular"></v-text-field></td>
                    <td>
                        <input type="hidden" :name="'commission['+index+'][type]'" :value="item.type">
                        <v-select
                                :items="types"
                                label="Select a type"
                                v-model="item.type"
                                item-value="value"
                                item-text="text"
                        ></v-select>
                    </td>
                    <td>
                        <v-btn icon color="red" @click="removeRow(index)">
                            <v-icon color="white">delete</v-icon>
                        </v-btn>
                    </td>
                </tr>
                </tbody>
            </table>

        <div class="m-portlet__foot">
            <div class="row align-items-center">
                <div class="col-lg-6 m--valign-middle">
                </div>
                <div class="col-lg-6 m--align-right">
                    <button type="button" class="btn btn-link" @click="addNewRow"><i class="flaticon-plus"></i> Add new row</button>
                </div>
                <div class="col-lg-6 m--align-right">
                    <v-btn type="submit" color="success" :loading="saveLoading">Save</v-btn>
                </div>
            </div>
        </div>
        </form>
    </v-app>
</template>

<script>
    import snackbar from './Snackbar'
    import Vue from 'vue';

    export default {
        props: ['id'],

        components: {
            snackbar
        },

        created() {
            console.log(this.id);
        },

        data() {
            return {
                saveLoading: false,
                list: app.transferMoneyCommissionList,
                types: app.valueTypes
            }
        },

        methods: {
            addNewRow() {
                this.list.push({});
            },

            removeRow(index) {
                this.list.splice(index, 1);
            },

            checkForm(e) {
                e.preventDefault();
                e.stopPropagation();
                this.saveLoading = true;
                let form = new FormData(e.srcElement);
                this.$http.post('/transfer-money-matrix/save-commission?id=' + this.id, form).then((response) => {
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

        }
    }
</script>