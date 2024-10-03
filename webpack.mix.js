const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .vue({ version: 3 })
   .css('resources/css/login.css', 'public/css');
   
   
