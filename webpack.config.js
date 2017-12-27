require('dotenv').config()
const path = require('path')
const webpack = require('webpack')

const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const FriendlyErrorsPlugin = require('friendly-errors-webpack-plugin')
const WebpackNotifierPlugin = require('webpack-notifier')
const ManifestPlugin = require('webpack-manifest-plugin')
const LodashModuleReplacementPlugin = require('lodash-webpack-plugin')
const BundleAnalyzerPlugin = require(
  'webpack-bundle-analyzer').BundleAnalyzerPlugin

const production = process.env.NODE_ENV === 'production'
const devServerPort = parseInt(process.env.DEV_SERVER_PORT || '8080', 10)

const publicPath = production
  ? '/dist/'
  : `http://localhost:${devServerPort}/dist/`

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
      'vue',
      'vue-router',
      'vuex',
      'vue-i18n',
      'bootstrap-vue',
      'axios',
      'sweetalert2',
      'toastr',
      'intl-tel-input',
      'pwstrength-bootstrap/dist/pwstrength-bootstrap',
      'vee-validate'
    ],
    vendor_frontend: [
      'bootstrap',
      'cookieconsent',
      'slick-carousel'
    ],
    vendor_backend: [
      'vue-select',
      'flatpickr',
      'chart.js',
      'quill',
      'vue-chartjs',
      'datatables.net',
      'datatables.net-bs4',
      'datatables.net-select',
      'datatables.net-buttons',
      'datatables.net-buttons-bs4',
      'datatables.net-responsive',
      'datatables.net-responsive-bs4'
    ],
    locales: [
      './resources/assets/js/vue-i18n-locales.generated.js'
    ]
  },
  output: {
    path: path.resolve(__dirname, 'public/dist'),
    filename: production ? 'js/[name].[chunkhash].js' : 'js/[name].js',
    publicPath
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
                ident: 'postcss',
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
            }
          ]
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
              publicPath
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
          },
          publicPath
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
    new webpack.ContextReplacementPlugin(/moment[/\\]locale$/, /fr/),
    new webpack.LoaderOptionsPlugin({
      minimize: production,
      options: {
        context: __dirname,
        output: path.resolve(__dirname, 'public/dist/')
      }
    }),
    new FriendlyErrorsPlugin(),
    new WebpackNotifierPlugin(),
    new webpack.optimize.CommonsChunkPlugin({
      names: [
        'locales',
        'vendor_frontend',
        'vendor_backend',
        'vendor',
        'manifest'
      ],
      minChunks: Infinity
    }),
    new LodashModuleReplacementPlugin({
      collections: true,
      shorthands: true
    }),
    new ExtractTextPlugin({
      filename: production ? 'css/[name].[contenthash].css' : 'css/[name].css',
      allChunks: false,
      disable: !production
    }),
    new ManifestPlugin({
      publicPath,
      writeToFileEmit: true
    })
  ],
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    }
  },
  performance: {
    hints: false
  },
  devtool: production ? 'source-map' : 'inline-source-map',
  devServer: {
    contentBase: path.resolve(__dirname, 'public'),
    publicPath: '/dist/',
    headers: {
      'Access-Control-Allow-Origin': '*'
    },
    compress: true,
    historyApiFallback: true,
    watchOptions: {
      ignored: /node_modules/
    },
    port: devServerPort
  }
}

let plugins = []

if (production) {
  plugins = [
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('production')
      }
    }),
    new UglifyJsPlugin({
      parallel: true,
      sourceMap: true
    }),
    new webpack.optimize.ModuleConcatenationPlugin(),
    new BundleAnalyzerPlugin()
  ]
} else {
  plugins = [
    new webpack.NamedModulesPlugin()
  ]
}

module.exports.plugins.push(...plugins)
