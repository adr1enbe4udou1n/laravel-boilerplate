require('dotenv').config();
const fs = require('fs');
const path = require('path');
const webpack = require('webpack');

const ExtractTextPlugin = require('extract-text-webpack-plugin');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');
const WebpackNotifierPlugin = require('webpack-notifier');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const StatsWriterPlugin = require('webpack-stats-plugin').StatsWriterPlugin;
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const production = process.env.NODE_ENV === 'production';
const hmr = process.argv.includes('--hot');

const browserSyncHost = process.env.BROWSERSYNC_HOST || 'localhost';
const browserSyncPort = parseInt(process.env.BROWSERSYNC_PORT || '3000', 10);
const webpackDevServerPort = parseInt(process.env.WEBPACKDEVSERVER_PORT || '8080', 10);

// Hot reloading file for Laravel detection
const hotfilename = 'public/hot';

if (fs.existsSync(hotfilename)) {
    fs.unlinkSync(hotfilename);
}

if (hmr) {
    fs.writeFileSync(hotfilename, 'hot reloading');
}

const extractSass = new ExtractTextPlugin({
    filename: production ? 'dist/css/[name].[contenthash].css' : 'css/[name].css',
    disable: hmr
});

module.exports = {
    entry: {
        frontend: [
            './resources/assets/js/frontend/app.js',
            './resources/assets/sass/frontend/app.scss'
        ],
        backend: [
            './resources/assets/js/backend/app.js',
            './resources/assets/sass/backend/app.scss'
        ],
        vendor: [
            'lodash',
            'moment',
            'jquery',
            'vue',
            'axios',
            'datatables.net',
            'select2',
            'sweetalert2',
            'slick-carousel'
        ]
    },
    output: {
        path: path.join(__dirname, '/public'),
        filename: production ? 'dist/js/[name].[chunkhash].js' : 'js/[name].js',
        publicPath: hmr ? `http://localhost:${webpackDevServerPort}/` : '/'
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: extractSass.extract({
                    use: [{
                        loader: 'css-loader',
                        options: {
                            sourceMap: true
                        }
                    }, {
                        loader: 'postcss-loader',
                        options: {
                            sourceMap: true,
                            plugins: [
                                require('postcss-import')()
                            ]
                        }
                    }, {
                        loader: 'resolve-url-loader?sourceMap'
                    }, {
                        loader: 'sass-loader',
                        options: {
                            precision: 8,
                            outputStyle: 'expanded',
                            sourceMap: true
                        }
                    }],
                    fallback: 'style-loader'
                })
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    loaders: {
                        js: 'babel-loader?cacheDirectory',
                        scss: 'vue-style-loader!css-loader!sass-loader',
                        sass: 'vue-style-loader!css-loader!sass-loader?indentedSyntax'
                    }
                }
            },
            {
                test: /\.jsx?$/,
                exclude: /(node_modules|bower_components)/,
                use: 'babel-loader?cacheDirectory'
            },
            {
                test: /\.html$/,
                loaders: ['html-loader']
            },
            {
                test: /\.(png|jpe?g|gif)$/,
                loaders: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: path => {
                                if (!/node_modules|bower_components/.test(path)) {
                                    return 'images/[name].[ext]?[hash]';
                                }

                                return 'images/vendor/' + path
                                        .replace(/\\/g, '/')
                                        .replace(
                                            /((.*(node_modules|bower_components))|images|image|img|assets)\//g, ''
                                        ) + '?[hash]';
                            },
                            publicPath: '/'
                        }
                    },
                    'img-loader'
                ]
            },
            {
                test: /\.(woff2?|ttf|eot|svg|otf)$/,
                loader: 'file-loader',
                options: {
                    name: 'fonts/[name].[ext]?[hash]'
                }
            }
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            jQuery: 'jquery',
            $: 'jquery'
        }),
        new FriendlyErrorsWebpackPlugin(),
        new webpack.LoaderOptionsPlugin({
            minimize: production,
            options: {
                context: __dirname,
                output: {path: './'}
            }
        }),
        new WebpackNotifierPlugin(),
        new webpack.optimize.CommonsChunkPlugin({
            names: ['vendor', 'manifest'],
            minChunks: Infinity
        }),
        extractSass,
        new BrowserSyncPlugin(
            {
                host: browserSyncHost,
                port: browserSyncPort,
                open: browserSyncHost === 'localhost' ? 'local' : 'external',
                proxy: {
                    target: process.env.BROWSERSYNC_PROXY,
                    reqHeaders: function (config) {
                        return {
                            host: `${config.url.hostname}:${process.env.BROWSERSYNC_PORT}`
                        };
                    }
                },
                files: [
                    'app/**/*.php',
                    'resources/views/**/*.php',
                    'public/js/**/*.js',
                    'public/css/**/*.css'
                ]
            },
            {
                reload: false
            }
        )
    ],
    resolve: {
        extensions: ['*', '.js', '.jsx', '.vue'],

        alias: {
            vue$: 'vue/dist/vue.common.js'
        }
    },
    performance: {
        hints: false
    },
    devtool: production ? 'cheap-source-map' : 'cheap-module-eval-source-map',
    devServer: {
        headers: {
            "Access-Control-Allow-Origin": "*"
        },
        historyApiFallback: true,
        noInfo: true,
        compress: true,
        quiet: true,
        port: webpackDevServerPort
    }
};

let plugins = [];

if (production) {
    plugins = [
        new CleanWebpackPlugin(['dist', 'images/vendor'], {
            root: path.join(__dirname, '/public')
        }),
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: true,
            compress: {
                warnings: false
            }
        }),
        new StatsWriterPlugin({
            filename: 'assets-manifest.json',
            transform(data) {
                return JSON.stringify({
                    '/js/manifest.js': `/${data.assetsByChunkName.manifest[0]}`,
                    '/js/vendor.js': `/${data.assetsByChunkName.vendor[0]}`,
                    '/js/frontend.js': `/${data.assetsByChunkName.frontend[0]}`,
                    '/css/frontend.css': `/${data.assetsByChunkName.frontend[1]}`,
                    '/js/backend.js': `/${data.assetsByChunkName.backend[0]}`,
                    '/css/backend.css': `/${data.assetsByChunkName.backend[1]}`
                }, null, 2);
            }
        })
    ];
}

module.exports.plugins.push(...plugins);
