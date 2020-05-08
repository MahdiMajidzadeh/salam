const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |js('resources/js/app.js', 'public/js')
 */

mix.sass('resources/scss/shards.scss', 'public/css')
    .copy('resources/js/shards.min.js', 'public/js/shards.min.js')
    .version();
