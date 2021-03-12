<template>
    <v-app>
        <snackbar></snackbar>
        <v-dialog
                v-model="dialog"
                max-width="390"
        >
            <v-card>
                <v-card-title class="headline">Bind data</v-card-title>

                <v-card-text>
                    description
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-select
                            v-model="dialogModel"
                            :items="dialogList"
                            :item-text="dialogDataText"
                            :item-value="dialogDataKey"
                            label="Select data"
                    ></v-select>

                    <v-btn
                            color="green darken-1"
                            flat="flat"
                            @click="saveData()"
                    >
                        save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-container id="dropdown-example" grid-list-xl>
            <v-progress-linear v-if="saveLoading" color="info" :indeterminate="true"></v-progress-linear>
        <ul>
            <li v-for="(countryData, country_id) in transferMoneyTree">
                {{countryName(country_id, transferMoneyTree)}}
                <v-btn fab dark small color="red" @click="deleteData(country_id, transferMoneyTree)">
                    <v-icon dark>remove</v-icon>
                </v-btn>
                <ul>
                    <li v-for="(transferTypeData, transfer_type_id) in (countryData || {})">
                        {{transferTypeName(transfer_type_id, countryData)}} <span @click="toggleMenu($event)">toggle</span>
                        <v-btn fab dark small color="red" @click="deleteData(transfer_type_id, countryData)">
                            <v-icon dark>remove</v-icon>
                        </v-btn>
                        <ul>
                            <li v-for="(agentData, agent_id) in (transferTypeData || {})">
                                {{transferAgentName(agent_id, transferTypeData)}}

                                <commissionDialog
                                        :commission-data="agentData.commission"
                                        :max-amount="agentData.maxAmount"
                                        @onchange="saveCommissionData($event, agentData)">
                                </commissionDialog>

                                <v-btn fab dark small color="red" @click="deleteData(agent_id, transferTypeData)">
                                    <v-icon dark>remove</v-icon>
                                </v-btn>
                                <ul>
                                    <li v-for="(pickup_bank_id, index) in agentData.pickupBankList || []">
                                        {{transferPickupBankName(pickup_bank_id, agentData.pickupBankList)}}
                                        <v-btn fab dark small color="red" @click="deleteData(index, agentData.pickupBankList)">
                                            <v-icon dark>remove</v-icon>
                                        </v-btn>
                                    </li>
                                    <li><v-btn color="success" @click="addData('transferPickupBankList', 'transfer_pickup_bank_id', 'label', agentData.pickupBankList)">Add transfer pickup bank</v-btn></li>
                                </ul>
                            </li>
                            <li><v-btn color="success" @click="addData('transferAgentList', 'transfer_agent_id', 'label', transferTypeData)">Add transfer agent</v-btn></li>
                        </ul>
                    </li>
                    <li><v-btn color="success" @click="addData('transferTypeList', 'transfer_type_id', 'label', countryData)">Add transfer type</v-btn></li>
                </ul>
            </li>
            <li><v-btn color="success" @click="addData('countryList', 'country_id', 'name', transferMoneyTree)">Add country</v-btn></li>
        </ul>
        </v-container>

        <v-btn color="success" @click="save()">Save dada</v-btn>
    </v-app>
</template>


<script>
    import Vue from 'vue'
    import draggable from 'vuedraggable'
    import snackbar from './Snackbar'
    import commissionDialog from './CommissionDialog'
    import qs from 'qs'

    export default {
        data: () => ({
            dialog         : false,
            commissionsDialog: false,
            dialogList     : [],
            dialogData     : {},
            dialogDataKey  : '',
            dialogDataText : '',
            dialogModel    : '',

            saveLoading: false,

            toggleMenus: {
                country            : true,
                transferType       : true,
                transferAgent      : true,
                transferPickupBank : true,
            },

            //config tree
            transferMoneyTree: app.transferMoneyData,

            //models
            country            : '',
            transferType       : false,
            transferAgent      : false,
            transferPickupBank : false,

            countryList            : app.countryList,
            transferTypeList       : app.transferTypeList,
            transferAgentList      : app.transferAgentList,
            transferPickupBankList : app.transferPickupBankList
        }),

        components: {snackbar, commissionDialog},

        created() {

        },

        mounted() {
            //get tree
        },

        methods: {
            toggleMenu(e) {
                console.log(e);
                var target = e.target;
                var parent = target.parentElement;//parent of "target"
                console.log(target, parent);
                parent.classList.toggle("visible");
            },

            saveCommissionData($event, agentData) {
                console.log($event, agentData);
                Vue.set(agentData, 'maxAmount', $event.maxAmount);
            },

            saveTree() {

            },

            deleteData(key, data) {
                Vue.delete(data, key);
            },

            addData(listName, key, text, data) {
                this.dialogList     = this[listName];
                this.dialogListName = listName;
                this.dialogDataKey  = key;
                this.dialogDataText = text;
                this.dialogData     = data;
                this.dialogModel    = '';
                this.dialog         = true;
            },

            saveData() {
                this.dialog = false;
                if(this.dialogModel && !(this.dialogModel in this.dialogData)) {
                    if(this.dialogListName == 'transferAgentList') {
                        console.log(this.dialogListName, this.dialogData, this.dialogModel);
                        Vue.set(this.dialogData, this.dialogModel, {
                            commission     : [],
                            maxAmount      : null,
                            pickupBankList : []
                        });

                    } else if(this.dialogListName == 'transferPickupBankList') { console.log(this.dialogData);
                        const set = new Set(this.dialogData);
                        if(!set.has(this.dialogModel)) {
                            this.dialogData.push(this.dialogModel);
                        }
                    } else {
                        Vue.set(this.dialogData, this.dialogModel, {});
                    }
                }
            },

            save() {
                console.log(this.transferMoneyTree);
                this.saveLoading = true;
                //var formatObj = Object.assign.apply({}, this.transferMoneyTree);
                let data = JSON.stringify( this.transferMoneyTree );
                this.$http.post('/transfer-money/save', qs.stringify({tree: data})).then((response) => {
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

            // getDataName(keyName, key, data, text) {
            //     let obj = data.filter(d => d[keyName] == key)[0];
            //     if(!obj) {
            //         this.deleteData(key, data);
            //         return '';
            //     }
            //     return obj[text];
            // },

            countryName(country_id, data) {
                let c = this.countryList.filter(c => c.country_id == country_id)[0];
                if(!c) {
                    this.deleteData(country_id, data);
                    return '';
                }
                return c.name;
            },

            transferTypeName(transfer_type_id, data) {
                let tt = this.transferTypeList.filter(tt => tt.transfer_type_id == transfer_type_id)[0];
                if(!tt) {
                    this.deleteData(transfer_type_id, data);
                    return '';
                }
                return tt.label;
            },

            transferAgentName(transfer_agent_id, data) {
                let ta = this.transferAgentList.filter(ta => ta.transfer_agent_id == transfer_agent_id)[0];
                if(!ta) {
                    this.deleteData(transfer_agent_id, data);
                    return '';
                }
                return ta.label;
            },

            transferPickupBankName(transfer_pickup_bank_id, data) {
                let tp = this.transferPickupBankList.filter(tp => tp.transfer_pickup_bank_id == transfer_pickup_bank_id)[0];
                if(!tp) {
                    this.deleteData(transfer_pickup_bank_id, data);
                    return '';
                }
                return tp.label;
            }
        }
    }
</script>