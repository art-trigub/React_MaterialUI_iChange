<template>
    <div>
        <a v-if="!copied" href="#" @click="copy($event)" class="link link_blue">
            <span>{{t('app', 'Copy link')}}</span>
            <svg class="icon" width="19" height="20">
                <use xlink:href="#icon-share"></use>
            </svg>
        </a>
        <span v-else class="link link_blue saved-link">
            {{t('app', 'Link copied')}}
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            url: {
                type: [String],
                default: ''
            }
        },

        data() {
            return {
                copied: false
            }
        },

        created() {

        },

        methods: {
            copy(e) {
                e.preventDefault();
                const el = document.createElement('textarea');
                el.value = this.url;
                el.setAttribute('readonly', '');
                el.style.position = 'absolute';
                el.style.left = '-9999px';
                document.body.appendChild(el);
                el.select();
                try {
                    this.copied = document.execCommand('copy');
                    let msg = this.copied ? 'successful' : 'unsuccessful';
                } catch (err) {
                }

                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            }
        }
    }

</script>