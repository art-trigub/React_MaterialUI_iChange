<template>
    <v-app color="white">
        <snackbar></snackbar>
        <template v-if="form">
        <form ref="form"
              @submit="checkForm"
              action="/cards/save-params"
              method="post"
              novalidate="true">
            <v-progress-linear v-if="itemsLoading" color="info" :indeterminate="true"></v-progress-linear>
            <draggable v-model="items" tag="div" class="container">
                <div class="param m-alert m-alert--air m-alert--square alert" v-for="(item, i) in items">
                    <div class="param__input">
                        <input type="hidden" :name="'Card[cardParams][' + i + '][card_param_id]'" :value="item.card_param_id"/>
                        <input type="text" v-model="item.name" :name="'Card[cardParams][' + i + '][name]'" class="form-control m-input">
                    </div>
                    <div class="param_action">
                        <v-btn icon color="red" @click="removeParam(i)">
                            <v-icon color="white">delete</v-icon>
                        </v-btn>
                    </div>
                </div>
            </draggable>
            <div class="m-portlet__foot">
                <div class="row align-items-center">
                    <div class="col-lg-6 m--valign-middle">
                        <button type="button" class="btn btn-link" @click="addNewParam"><i class="flaticon-plus"></i> Add new param</button>
                    </div>
                    <div class="col-lg-6 m--align-right">
                        <v-btn type="submit" color="success" :loading="saveLoading">Save</v-btn>
                    </div>
                </div>
            </div>
        </form>
        </template>
        <template v-else>
            <v-progress-linear v-if="itemsLoading" color="info" :indeterminate="true"></v-progress-linear>
            <draggable v-model="items" tag="div" class="container">
                <div class="param m-alert m-alert--air m-alert--square alert" v-for="(item, i) in items">
                    <div class="param__input">
                        <input type="hidden" :name="'Card[cardParams][' + i + '][card_param_id]'" :value="item.card_param_id"/>
                        <input type="text" v-model="item.name" :name="'Card[cardParams][' + i + '][name]'" class="form-control m-input">
                    </div>
                    <div class="param_action">
                        <v-btn icon color="red" @click="removeParam(i)">
                            <v-icon color="white">delete</v-icon>
                        </v-btn>
                    </div>
                </div>
            </draggable>
            <div class="m-portlet__foot">
                <div class="row align-items-center">
                    <div class="col-lg-6 m--valign-middle">
                    </div>
                    <div class="col-lg-6 m--align-right">
                        <button type="button" class="btn btn-link" @click="addNewParam"><i class="flaticon-plus"></i> Add new param</button>
                    </div>
                </div>
            </div>
        </template>
    </v-app>
</template>

<script>
    import draggable from 'vuedraggable'
    import snackbar from './Snackbar'
    import Vue from 'vue';

    export default {
        props: {
            lang: {
                type: [String],
                default: 'en'
            },
            card_id: {
                type: [Number, String],
                default: false
            },
            form: {
                type: [Boolean],
                default: true
            }
        },

        components: {
            draggable, snackbar
        },

        data: () => ({
            saveLoading: false,
            itemsLoading: false,
            items: []
        }),

        created() {
            console.log(this.form);
            this.itemsLoading = true;
            this.$http.get('/admin/cards/get-params', {
                params: {
                    'lang_id': this.lang,
                    'card_id': this.card_id
                }
            }).then((response) => {
                this.items = response.data;
                this.itemsLoading = false;
            }, e => {
                this.itemsLoading = false;
                console.error(e);
            });
        },

        methods: {

            checkForm(e) {
                e.preventDefault();
                e.stopPropagation();
                this.saveLoading = true;
                let form = new FormData(e.srcElement);
                this.$http.post('/admin/cards/save-params?card_id=' + this.card_id + '&lang_id=' + this.lang, form).then((response) => {
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

            addNewParam() {
                this.items.push({});
            },

            removeParam(index) {
                this.items.splice(index, 1);
            }
        }
    }
</script>


<style lang="scss" scoped>
    .param{
        display:flex;
        &__input{
            flex:1
        }
        &__action{
            flex:0 0 50px;
        }
    }
    .m-portlet__body{
        padding:0 !important;
    }
</style>