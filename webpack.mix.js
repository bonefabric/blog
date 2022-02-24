const mix = require('laravel-mix');

// mix.js('resources/js/old/app.js', 'public/old/js')
//     .sass('resources/sass/old/app.scss', 'public/old/css')
//     .sourceMaps();

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
