<template>
    <v-snackbar
            :top="true"
            v-model="show"
            :timeout="2000"
            :color="color"
    >
        <span v-html="message"></span>
        <v-btn flat @click.native="show = false">Close</v-btn>
    </v-snackbar>
</template>

<script>
    export default {
        data () {
            return {
                show    : false,
                color   : '',
                message : ''
            }
        },
        created: function () {
            this.$store.watch(state => state.snack, () => {
                const msg = this.$store.state.snack.msg
                if (msg !== '') {
                    this.show = true
                    this.color = this.colorByType;
                    this.message = this.messageNormalized;
                    this.$store.commit('setSnack', {
                        type : '',
                        msg  : ''
                    })
                }
            }, {
                deep: true
            })
        },

        computed: {
            colorByType() {
                let type = this.$store.state.snack.type;
                if(type == 'success') {
                    return 'green';
                } else if(type == 'fail') {
                    return 'red';
                }

                return 'black';
            },

            messageNormalized() {
                let msg = this.$store.state.snack.msg;
                if(typeof msg == 'object') {
                    return msg.join('<br/>');
                }

                return msg;
            }
        }
    }
</script>