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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/adminlte.js', 'public/js')
    .js('resources/js/homepage.js', 'public/js')
    .js('resources/js/firebase.js', 'public/js')
    .sass('resources/sass/adminlte/app.scss', 'public/css')
    .sourceMaps();

mix.postCss('resources/css/homepage.css', 'public/css').options({
    processCssUrls: false
});
