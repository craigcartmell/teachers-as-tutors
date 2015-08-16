var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'jquery': './node_modules/jquery/',
    'bootstrap': './node_modules/bootstrap-sass/assets/',
    'bootstrapmarkdown': './node_modules/bootstrap-markdown/',
    'markdown': './node_modules/markdown/',
    'moment': './node_modules/moment/',
    'fullcalendar': './node_modules/fullcalendar/',
    'clockpicker': './node_modules/clockpicker/'
};

elixir(function (mix) {
    mix.sass('main.scss', 'public/css/all.css', {includePaths: [paths.bootstrap + 'stylesheets/']})
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/build/fonts/bootstrap/')
        .copy([paths.bootstrapmarkdown + 'css/bootstrap-markdown.min.css', paths.fullcalendar + 'dist/fullcalendar.min.css', paths.clockpicker + 'dist/bootstrap-clockpicker.min.css'], 'public/build/css/')
        .scripts([
            paths.jquery + 'dist/jquery.js',
            paths.bootstrap + 'javascripts/bootstrap.js',
            paths.bootstrapmarkdown + 'js/bootstrap-markdown.js',
            paths.markdown + 'lib/markdown.js',
            paths.moment + 'min/moment.min.js',
            paths.fullcalendar + 'dist/fullcalendar.min.js',
            paths.clockpicker + 'dist/bootstrap-clockpicker.min.js',
            'resources/assets/js/main.js',
            'resources/assets/js/lesson.js',
            'resources/assets/js/calendar.js'
        ], 'public/js/app.js', './')
        .version(['css/all.css', 'js/app.js']);
});