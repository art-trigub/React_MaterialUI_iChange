const mix = require('laravel-mix');
let webpack = require('webpack');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


 mix
    .js('resources/js/vueapp.js', 'web/js')
    .js('resources/js/currencyCalc.js', 'web/js')
    .js('resources/js/account/account.js', 'modules/account/assets/js')
    .sass('resources/sass/app.scss', 'web/css');


mix.webpackConfig({
    entry: {
        vendor: [
            'vue',
            'axios',
            'lodash',
            'vue-router'
            // 'promise-polyfill',
            // 'setasap'
        ]
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            names: ["commons", "vendor"],
            filename: 'web/js/[name].js',
            minChunks: 2
        })
    ]
});