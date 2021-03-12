export default {
    install(Vue, options) {
        console.log('Installing the Locale plugin!');
        // Fun will happen here

        let translates = options.translates || {};

        Vue.prototype.$lang = options.language || 'en';
        Vue.prototype.langUrl = (url) => {
            return '/' + Vue.prototype.$lang + '/' + url.replace(/^\/|\/$/g, '');
        }
        Vue.mixin({
            methods: {
                t (category, name) {
                    if(translates[category] && translates[category][name]) {
                        return translates[category][name];
                    } else {
                        return name;
                    }
                },

                langUrl: Vue.prototype.langUrl
            }
        });
    }
}