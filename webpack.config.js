require('dotenv').config()
const fs = require('fs')
const _ = require('lodash')
const path = require('path')
const webpack = require('webpack')

const ExtractTextPlugin = require('extract-text-webpack-plugin')
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin')
const WebpackNotifierPlugin = require('webpack-notifier')
const ManifestPlugin = require('webpack-manifest-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const CopyWebpackPlugin = require('copy-webpack-plugin')
const LodashModuleReplacementPlugin = require('lodash-webpack-plugin')
const WebpackBundleSizeAnalyzerPlugin = require('webpack-bundle-size-analyzer').WebpackBundleSizeAnalyzerPlugin

const production = process.env.NODE_ENV === 'production'
const hmr = process.argv.includes('--hot')

const browserSyncHost = process.env.BROWSERSYNC_HOST || 'localhost'
const browserSyncPort = parseInt(process.env.BROWSERSYNC_PORT || '3000', 10)
const webpackDevServerPort = parseInt(process.env.WEBPACKDEVSERVER_PORT ||
  '8080', 10)

// Hot reloading file for Laravel detection
const hotfilename = 'public/hot'

if (fs.existsSync(hotfilename)) {
  fs.unlinkSync(hotfilename)
}

if (hmr) {
  fs.writeFileSync(hotfilename, 'hot reloading')
}

let ckeditorLocales = ['en', 'fr']
let ckeditorPlugins = [
  'a11yhelp',
  'about',
  'autogrow',
  'dialog',
  'divarea',
  'filetools',
  'image',
  'image2',
  'lineutils',
  'link',
  'magicline',
  'notificationaggregator',
  'pastefromword',
  'scayt',
  'specialchar',
  'table',
  'tableselection',
  'tabletools',
  'uploadimage',
  'uploadwidget',
  'widget',
  'widgetselection',
  'wsc'
]

// Locales to exclude from ckeditor core, including plugins
let ckeditorIgnoredLanguages = []

fs.readdirSync('node_modules/ckeditor/lang').forEach((file) => {
  if (_.some(ckeditorLocales, (locale) => {
    return file === `${locale}.js`
  }) === false) {
    ckeditorIgnoredLanguages.push(file)
  }
})

let ckeditorCopyPatterns = [
  {
    from: 'node_modules/ckeditor/lang',
    to: 'vendor/ckeditor/lang'
  },
  {
    from: 'node_modules/ckeditor/plugins/icons.png',
    to: 'vendor/ckeditor/plugins'
  },
  {
    from: 'node_modules/ckeditor/plugins/icons_hidpi.png',
    to: 'vendor/ckeditor/plugins'
  },
  {
    from: 'node_modules/ckeditor/skins/moono-lisa',
    to: 'vendor/ckeditor/skins/moono-lisa'
  },
  {
    from: 'node_modules/ckeditor/config.js',
    to: 'vendor/ckeditor'
  },
  {
    from: 'node_modules/ckeditor/contents.css',
    to: 'vendor/ckeditor'
  },
  {
    from: 'node_modules/ckeditor/styles.js',
    to: 'vendor/ckeditor'
  }
]

ckeditorPlugins.forEach((plugin) => {
  ckeditorCopyPatterns.push({
    from: `node_modules/ckeditor/plugins/${plugin}`,
    to: `vendor/ckeditor/plugins/${plugin}`
  })
})

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
      'jquery',
      'popper.js',
      'bootstrap',
      'vue',
      'axios',
      'sweetalert2',
      'slick-carousel',
      'flatpickr',
      'intl-tel-input',
      'toastr'
    ],
    ckeditor: [
      'ckeditor'
    ]
  },
  output: {
    path: path.resolve(__dirname, 'public'),
    filename: production ? 'dist/js/[name].[chunkhash].js' : 'js/[name].js',
    publicPath: hmr ? `http://${browserSyncHost}:${webpackDevServerPort}/` : '/'
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {
              loader: 'css-loader',
              options: {
                sourceMap: true,
                importLoaders: 1
              }
            }, {
              loader: 'postcss-loader',
              options: {
                sourceMap: true,
                plugins: [
                  require('autoprefixer')
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
            }]
        })
      },
      {
        test: /\.(js|vue)$/,
        loader: 'eslint-loader',
        enforce: 'pre'
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
        exclude: /node_modules/,
        loader: 'babel-loader?cacheDirectory'
      },
      {
        test: /\.html$/,
        loader: 'html-loader'
      },
      {
        test: /\.(png|jpe?g|gif)$/,
        loaders: [
          {
            loader: 'file-loader',
            options: {
              name: (path) => {
                if (!/node_modules/.test(path)) {
                  return 'images/[name].[ext]?[hash]'
                }

                return 'images/vendor/' + path
                  .replace(/\\/g, '/')
                  .replace(
                    /((.*(node_modules))|images|image|img|assets)\//g, ''
                  ) + '?[hash]'
              },
              publicPath: '/'
            }
          },
          {
            loader: 'img-loader',
            options: {
              enabled: production
            }
          }
        ]
      },
      {
        test: /\.(woff2?|ttf|eot|svg|otf)$/,
        loader: 'file-loader',
        options: {
          name: (path) => {
            if (!/node_modules/.test(path)) {
              return 'fonts/[name].[ext]?[hash]'
            }

            return 'fonts/vendor/[name].[ext]?[hash]'
          }
        }
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      Popper: ['popper.js', 'default']
    }),
    new webpack.IgnorePlugin(/jsdom$/),
    new CopyWebpackPlugin(ckeditorCopyPatterns, {
      ignore: ckeditorIgnoredLanguages
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
    new LodashModuleReplacementPlugin({
      collections: true,
      shorthands: true
    }),
    new ExtractTextPlugin({
      filename: production
        ? 'dist/css/[name].[contenthash].css'
        : 'css/[name].css',
      allChunks: true,
      disable: !production
    }),
    new WebpackBundleSizeAnalyzerPlugin('./plain-report.txt'),
    new BrowserSyncPlugin(
      {
        host: browserSyncHost,
        port: browserSyncPort,
        open: browserSyncHost === 'localhost' ? 'local' : 'external',
        proxy: process.env.BROWSERSYNC_PROXY,
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
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    }
  },
  performance: {
    hints: false
  },
  devtool: production ? 'source-map' : 'cheap-module-eval-source-map',
  devServer: {
    headers: {
      'Access-Control-Allow-Origin': '*'
    },
    contentBase: path.resolve('public'),
    historyApiFallback: true,
    noInfo: true,
    compress: true,
    quiet: true,
    host: browserSyncHost,
    port: webpackDevServerPort
  }
}

let plugins = []

if (hmr) {
  plugins = [
    new webpack.NamedModulesPlugin()
  ]
}

if (production) {
  plugins = [
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('production')
      }
    }),
    new webpack.optimize.ModuleConcatenationPlugin(),
    new webpack.optimize.UglifyJsPlugin({
      sourceMap: true,
      compress: {
        warnings: false
      }
    }),
    new ManifestPlugin()
  ]
}

module.exports.plugins.push(...plugins)
