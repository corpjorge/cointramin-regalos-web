const mix = require('laravel-mix');

mix.sass('resources/scss/sb-admin-2.scss', 'public/css')
    .js('resources/js/sb-admin-2.js', 'public/js')
    .js('resources/js/app/main.js', 'public/js/app').vue();
