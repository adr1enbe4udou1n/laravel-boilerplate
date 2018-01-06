require('dotenv').config()
const path = require('path')
const webpack = require('webpack')

const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const FriendlyErrorsPlugin = require('friendly-errors-webpack-plugin')
const WebpackNotifierPlugin = require('webpack-notifier')
const ManifestPlugin = require('webpack-manifest-plugin')
const LodashModuleReplacementPlugin = require('lodash-webpack-plugin')
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin

const hmr = process.argv.includes('--hot')
const production = process.env.NODE_ENV === 'production'
const devServerPort = parseInt(process.env.DEV_SERVER_PORT || '8080', 10)

const publicPathFolder = production ? '/dist/' : '/build/'
const publicPath = hmr ? `http://localhost:${devServerPort}${publicPathFolder}` : publicPathFolder

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
    locales: [
      './resources/assets/js/vue-i18n-locales.generated.js'
    ]
  },
  output: {
    path: path.resolve(__dirname, 'public' + publicPathFolder),
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
    new webpack.IgnorePlugin(/jsdom$/),
    new webpack.ContextReplacementPlugin(/moment[/\\]locale$/, /fr/),
    new webpack.LoaderOptionsPlugin({
      minimize: production
    }),
    new FriendlyErrorsPlugin({
      clearConsole: false
    }),
    new WebpackNotifierPlugin(),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'vendor_frontend',
      chunks: ['frontend'],
      minChunks: (module) => {
        return module.context && module.context.includes('node_modules')
      }
    }),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'vendor_backend',
      chunks: ['backend'],
      minChunks: (module) => {
        return module.context && module.context.includes('node_modules')
      }
    }),
    new webpack.optimize.CommonsChunkPlugin({
      names: [
        'locales',
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
      disable: hmr
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
  externals: {
    jquery: 'jQuery',
    'popper.js': 'Popper'
  },
  performance: {
    hints: false
  },
  devtool: production ? 'source-map' : 'inline-source-map',
  devServer: {
    contentBase: path.resolve(__dirname, 'public'),
    headers: {
      'Access-Control-Allow-Origin': '*'
    },
    historyApiFallback: true,
    compress: true,
    noInfo: true,
    quiet: true,
    watchOptions: {
      ignored: /node_modules/
    },
    port: devServerPort
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
    new UglifyJsPlugin({
      parallel: true,
      sourceMap: true
    }),
    new webpack.optimize.ModuleConcatenationPlugin(),
    new BundleAnalyzerPlugin()
  ]
}

module.exports.plugins.push(...plugins)
