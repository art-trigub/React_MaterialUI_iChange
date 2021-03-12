<template>
    <v-dialog
            max-width="390"
            v-model="dialog"
    >
        <template v-slot:activator="{ on }">
            <v-btn
                    color="red lighten-2"
                    dark
                    v-on="on"
            >
                Commission
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="headline">Commissions dialog</v-card-title>

            <v-card-text>
                <v-text-field
                        label="Max amount"
                        v-model="maxAmountModel"
                ></v-text-field>
            </v-card-text>

            <ul>
                <li v-for="(data, id) in commissionDataModel">

                </li>
            </ul>

            <v-btn
                    color="green darken-1"
                    flat="flat"
                    @click="commissionsDialog = false"
            >
                Add row
            </v-btn>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                        color="green darken-1"
                        flat="flat"
                        @click="save()"
                >
                    Close
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script>
    export default {
        props:{
            showCommissionDialog: {
                type: [Boolean],
                default: false
            },
            commissionData: {
                type: [Array, Object],
            },
            maxAmount: {
                type: [String, Number]
            }
        },

        created() {
            console.log(this.maxAmount, this.commissionData);

        },

        data() {
            return {
                dialog: false,
                commissionDataModel: this.commissionData,
                maxAmountModel: this.maxAmount
            }
        },

        methods: {
            save() {
                this.dialog = false;
                this.$emit('onchange', {
                    maxAmount      : this.maxAmountModel,
                    commissionData : this.commissionDataModel
                });
            }
        }
    }
</script>