var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss').version('public/css/app.css');
});

elixir(function(mix) {
 mix.scripts([
     '*.js',
     'classes/Helpers.js',
     'classes/UserInterface.js',
     'classes/ControlTable.js',
     'models/*.js',
     'controllers/*.js'

     ]).version('public/js/all.js');
});
