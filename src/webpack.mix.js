const mix = require('laravel-mix');

//mix.vue({ version: 3 });
//mix.vue({ version: 3 });

mix.js('./resources/js/main.js', './public/js').vue({ version: 3 })
    .sass('resources/sass/app.scss', 'public/css');
