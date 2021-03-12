<template>
    <div class="subscribe container" :class="{'success': subscribed}">
        <div class="subscribe__content">
            <div class="subscribe__wrap">
                <p class="subscribe__text">{{t('app', 'Subscribe and get newest articles and news on your email as soon as they are released.')}}</p>
                <form @submit="checkForm" class="subscribe__form" :class="{'error': errorList.length > 0}">
                    <!--<div v-if="errors.length">-->
                        <!--<b>Please correct the indicated errors:</b>-->
                        <!--<ul>-->
                            <!--<li v-for="error in errors">{{ error }}</li>-->
                        <!--</ul>-->
                    <!--</div>-->
                    <div class="subscribe__wrap-input">
                        <input class="subscribe__input" type="email" v-model="email" :placeholder="t('app', 'E-mail')">
                    </div>
                    <button class="btn btn_green" type="submit">{{t('app', 'Subscribe')}}</button>
                </form>
            </div>
            <div class="subscribe__success">
                <p class="subscribe__title">{{t('app', 'You’ve successfully subscribed!')}}</p>
                <button class="subscribe__close cross" @click="subscribed = false"></button>
            </div>
        </div>
    </div>
</template>

<script>
    import qs from 'qs'

    export default {
        data() {
            return {
                email: '',
                subscribed: false,
                errorList: []
            }
        },

        methods: {

            checkForm: function (e) {
                e.preventDefault();
                this.errorList = [];

                if (!this.email) {
                    this.errorList.push('Enter your email.');
                } else if (!this.validEmail(this.email)) {
                    this.errorList.push('Please enter a valid email address.');
                }

                if (!this.errorList.length) {
                    let data = {
                        email: this.email
                    }

                    this.$http.post(this.langUrl('/api/subscribe'), qs.stringify(data)).then(response => {
                        if(response.data.status == 'OK') {
                            this.subscribed = true;
                            setTimeout(() => {
                                this.subscribed = false;
                            }, 3000);
                        } else {
                            this.errors = [response.data.errors];
                            console.error(response.data.errors);
                        }
                    }).catch((e) => {
                        console.error(e);
                    })
                }
            },

            validEmail: function (email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        }
    }
</script>


<style scoped>
form.error input{
    border:solid 1px red;
}
</style>