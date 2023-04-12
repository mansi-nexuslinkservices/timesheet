const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

/* STYLES */
mix.copy('resources/css/toastr.min.css', 'public/backend/css');
mix.copy('resources/css/sweetalert2.min.css', 'public/backend/css');
mix.copy('resources/css/select2.min.css', 'public/backend/css');
mix.copy('resources/css/jquery.dataTables.min.css', 'public/backend/css');


/* JS */
mix.js('resources/js/bootstrap.js', 'public/backend/js');


