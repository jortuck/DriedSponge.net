const mix = require('laravel-mix');

//mix.vue({ version: 3 });
//mix.vue({ version: 3 });

mix.js('./resources/js/main.js', './public/js').vue({ version: 3 })
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
    mix.then(() => {
        const convertToFileHash = require("laravel-mix-make-file-hash");
        convertToFileHash({
            publicPath: "public",
            manifestFilePath: "public/mix-manifest.json",
            delOptions: {force:true}
        });
    });
}
