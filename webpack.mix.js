const mix = require('laravel-mix');

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

mix.styles([
            'node_modules/startbootstrap-sb-admin-2/css/sb-admin-2.css',
            'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
            'node_modules/toastr/build/toastr.min.css',
            ],
            'public/css/all.css')
    .scripts([
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
            'node_modules/jquery.easing/jquery.easing.min.js',
            'node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.js',
            'node_modules/chart.js/dist/Chart.min.js',
            'node_modules/toastr/build/toastr.min.js',
            'node_modules/sweetalert/dist/sweetalert.min.js',
            ],
            'public/js/all.js')
    .copyDirectory('resources/img', 'public/img')
    .copyDirectory('resources/fonts', 'public/fonts')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
