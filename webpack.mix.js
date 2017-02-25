require('dotenv').config();
const {mix} = require('laravel-mix');

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

    /**
     * Combine frontend scripts
     */
    .js('resources/assets/js/frontend/app.js', 'public/js/frontend.js')

    /**
     * Process frontend SCSS stylesheets
     */
    .sass('resources/assets/sass/frontend/app.scss', 'public/css/frontend.css')

    /**
     * Combine backend scripts
     */
    .js('resources/assets/js/backend/app.js', 'public/js/backend.js')

    /**
     * Process backend SCSS stylesheets
     */
    .sass('resources/assets/sass/backend/app.scss', 'public/css/backend.css')

    /**
     * Autoload global plugins
     */
    .autoload({
        jQuery: 'jquery',
        $: 'jquery'
    })

    /**
     * Extract vendors
     */
    .extract([
        'lodash',
        'moment',
        'jquery',
        'vue',
        'axios',
        'datatables.net',
        'select2',
        'sweetalert2',
        'slick-carousel'
    ])

    /**
     * Enable sourcemaps
     */
    .sourceMaps()

    /**
     * Enable browsersync
     */
    .browserSync({
        proxy: {
            target: process.env.BROWSERSYNC_PROXY,
            reqHeaders: function (config) {
                return {
                    host: `${config.url.hostname}:${process.env.BROWSERSYNC_PORT}`
                };
            }
        },
        open: 'external',
        host: process.env.BROWSERSYNC_HOST || 'localhost',
        port: parseInt(process.env.BROWSERSYNC_PORT, 10)
    });

if (mix.config.inProduction) {
    /**
     * Cache busting for production
     */
    mix.version();
}
