let mix = require('laravel-mix');

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
    .js("resources/assets/js/app.js","public/js")
    .js('resources/assets/js/src/specialties.js', 'public/js')
    .js('resources/assets/js/src/schedules.js', 'public/js')
    .js('resources/assets/js/src/patients.js', 'public/js')
    .js('resources/assets/js/src/doctors.js', 'public/js')
    .js('resources/assets/js/src/user.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/sass');
