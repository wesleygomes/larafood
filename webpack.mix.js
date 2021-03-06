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

 mix
 .js('resources/js/app.js', 'public/js/app.js')
 .js('resources/js/maskMoney.js', 'public/js/maskMoney.js')
 .js('resources/js/maskedinput.js', 'public/js/maskedinput.js')
 .postCss('resources/css/app.css', 'public/css/app.css', [])
 .postCss('resources/css/site.css', 'public/css/site.css', [])
 .postCss('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.css', []);
