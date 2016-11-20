const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
require('dotenv').config();

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix
        /**
         * Process Fonts + images
         */
        .copy(
            ['node_modules/bootstrap-sass/assets/fonts/bootstrap', 'node_modules/font-awesome/fonts', 'node_modules/flexslider/fonts', 'resources/assets/fonts'],
            'public/css/fonts'
        )
        .copy(
            ['node_modules/icheck/skins/square/blue.png', 'node_modules/icheck/skins/square/blue@2x.png'],
            'public/css'
        )
        .copy(
            ['node_modules/bootstrap-sass/assets/fonts/bootstrap', 'node_modules/font-awesome/fonts', 'node_modules/flexslider/fonts', 'resources/assets/fonts'],
            'public/build/css/fonts'
        )
        .copy(
            ['node_modules/icheck/skins/square/blue.png', 'node_modules/icheck/skins/square/blue@2x.png'],
            'public/build/css'
        )

        /**
         * Process frontend SCSS stylesheets
         */
        .sass([
            'frontend/app.scss',
        ], 'public/css/frontend.css')

        /**
         * Combine frontend scripts
         */
        .webpack([
            'frontend/app.js'
        ], 'public/js/frontend.js')

        /**
         * Process backend SCSS stylesheets
         */
        .sass([
            'backend/app.scss',
        ], 'public/css/backend.css')

        /**
         * Combine backend scripts
         */
        .webpack([
            'backend/app.js'
        ], 'public/js/backend.js');

    if (elixir.inProduction) {
        // Versionning
        mix.version([
            "public/css/frontend.css",
            "public/js/frontend.js",
            "public/css/backend.css",
            "public/js/backend.js"
        ]);
    }
    else {
        // BrowserSync
        mix.browserSync({
            proxy: {
                target: process.env.BROWSERSYNC_PROXY,
                reqHeaders: function () {
                    return {
                        host: `${process.env.BROWSERSYNC_HOST}:${process.env.BROWSERSYNC_PORT}`
                    };
                }
            },
            open: 'external',
            host: process.env.BROWSERSYNC_HOST,
            port: parseInt(process.env.BROWSERSYNC_PORT)
        });
    }
});
