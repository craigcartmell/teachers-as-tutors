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
    'markdown': './node_modules/markdown/'
};

elixir(function (mix) {
    mix.sass("main.scss", 'public/css/all.css', {includePaths: [paths.bootstrap + 'stylesheets/']})
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/build/fonts/bootstrap/')
        .copy(paths.bootstrapmarkdown + 'css/bootstrap-markdown.min.css', 'public/build/css/')
        .scripts([
            paths.jquery + "dist/jquery.js",
            paths.bootstrap + "javascripts/bootstrap.js",
            paths.bootstrapmarkdown + "js/bootstrap-markdown.js",
            paths.markdown + 'lib/markdown.js',
            //paths.markdown + 'bin/md2html.js',
            'resources/assets/js/main.js'
        ], 'public/js/app.js', './')
        .version(["css/all.css", "js/app.js"]);
});