<template>
    <div class="useful__btn-wrap">
        <button :class="{'disabled': buttonsDisabled}" class="btn btn_green" @click="vote('like')">
            <span>{{t('app', 'Yes')}}</span>
            <svg class="icon" width="22" height="20">
                <use xlink:href="#icon-like"></use>
            </svg>
        </button>
        <button :class="{'disabled': buttonsDisabled}" class="btn btn_red" @click="vote('dislike')">
            <span>{{t('app', 'No')}}</span>
            <svg class="icon" width="22" height="20">
                <use xlink:href="#icon-like"></use>
            </svg>
        </button>
    </div>
</template>


<script>
    import qs from 'qs'

    export default{
        props: {
            url: {
                type: [String],
                default: false
            },

            disabled: {
                type: [Boolean],
                default: false
            }
        },

        data() {
            return {
                buttonsDisabled: this.disabled
            }
        },

        methods: {
            vote(action) {
                let data = {
                    url: this.url,
                    action: action
                }
                this.buttonsDisabled = true;
                this.$http.post(this.langUrl('/api/page/vote'), qs.stringify(data)).then((response) => {
                    if(response.data.status == 'OK') {

                    }

                    console.log(response);
                }).catch((e) => {
                    console.error(e);
                })
            }
        },
    }
</script>