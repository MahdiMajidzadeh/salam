const mix = require('laravel-mix');

mix.sass('resources/scss/nahar.scss', 'public/css')
    .copy('resources/js/bootstrap.bundle.min.js', 'public/js/bootstrap.bundle.min.js')
    .copy('resources/js/jquery-3.5.1.min.js', 'public/js/jquery-3.5.1.min.js')
    .copy('resources/js/shards.min.js', 'public/js/shards.min.js')
    .version();
