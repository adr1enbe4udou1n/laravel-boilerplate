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
     * Enable sourcemaps
     */
    .sourceMaps()

    /**
     * Enable browsersync
     */
    .browserSync(process.env.APP_URL);

if (mix.config.inProduction) {
    /**
     * Cache busting for production
     */
    mix.version();
}
