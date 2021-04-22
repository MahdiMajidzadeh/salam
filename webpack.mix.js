const mix = require('laravel-mix');

// mix.sass('resources/scss/nahar.scss', 'public/css')
//     .copy('resources/js/bootstrap.bundle.min.js', 'public/js/bootstrap.bundle.min.js')
//     .copy('resources/js/jquery-3.5.1.min.js', 'public/js/jquery-3.5.1.min.js')
//     .copy('resources/js/shards.min.js', 'public/js/shards.min.js')
//     .copyDirectory('resources/fonts', 'public/fonts')
//     .sourceMaps()
//     .version();

mix.sass('resources/scss/shards/shards.scss', 'public/css')
    .sass('resources/scss/bootstrap/bootstrap-rtl.scss', 'public/css')
    .sass('resources/scss/style.scss', 'public/css')
    .copy('resources/js/bootstrap.bundle.min.js', 'public/js/bootstrap.bundle.min.js')
    .copy('resources/js/jquery-3.5.1.min.js', 'public/js/jquery-3.5.1.min.js')
    .copy('resources/js/shards.min.js', 'public/js/shards.min.js')
    .copy('resources/js/persian-date.min.js', 'public/js/persian-date.min.js')
    .copy('resources/js/persian-datepicker.min.js', 'public/js/persian-datepicker.min.js')
    .copy('resources/js/jquery.autocomplete.min.js', 'public/js/jquery.autocomplete.min.js')
    .copy('resources/js/input-spinner.js', 'public/js/input-spinner.js')
    .copy('resources/js/sweetalert2.all.min.js', 'public/js/sweetalert2.all.min.js')
    .copy('resources/css/persian-datepicker.min.css', 'public/css/persian-datepicker.min.css')
    .copy('resources/css/materialdesignicons.min.css', 'public/css/materialdesignicons.min.css')
    .copy('resources/css/sweetalert2.min.css', 'public/css/sweetalert2.min.css')
    .copyDirectory('resources/fonts', 'public/fonts')
    .sourceMaps()
    .version();

if (mix.inProduction()) {
    mix.version();
}