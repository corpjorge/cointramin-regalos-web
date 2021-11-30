const mix = require('laravel-mix');

mix.sass('resources/scss/sb-admin-2.scss', 'public/css')
    .js('resources/js/sb-admin-2.js', 'public/js')
