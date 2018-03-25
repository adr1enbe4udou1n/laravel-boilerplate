require('dotenv').config()
const path = require('path')
const webpack = require('webpack')

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
                minimize: production,
                sourceMap: true
              }
            }, {
              loader: 'postcss-loader',
              options: {
                ident: 'postcss',
                sourceMap: true
              }
            }, {
              loader: 'resolve-url-loader'
            }, {
              loader: 'sass-loader',
              options: {
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
        loader: 'vue-loader'
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader'
      },
      {
        test: /\.(png|jpe?g|gif)$/,
        use: [
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
              }
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
  optimization: {
    splitChunks: {
      cacheGroups: {
        locales: {
          test: /vue-i18n-locales/,
          name: 'locales',
          chunks: 'all',
          priority: 2
        },
        vendor: {
          test: (module, chunks) => {
            if (!module.nameForCondition) {
              return false
            }
            const name = module.nameForCondition()
            return chunks.some((c) => c.name === 'frontend' && /node_modules/.test(name))
          },
          name: 'vendor',
          priority: 1,
          enforce: true,
          chunks: 'all'
        },
        backend: {
          test: (module, chunks) => {
            if (!module.nameForCondition) {
              return false
            }
            const name = module.nameForCondition()
            return chunks.some((c) => c.name === 'backend' && /node_modules/.test(name))
          },
          name: 'vendor_backend',
          priority: 0,
          enforce: true,
          chunks: 'all'
        }
      }
    }
  },
  plugins: [
    new webpack.IgnorePlugin(/jsdom$/),
    new webpack.ContextReplacementPlugin(/moment[/\\]locale$/, /fr/),
    new FriendlyErrorsPlugin({
      clearConsole: false
    }),
    new WebpackNotifierPlugin(),
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
  devtool: production ? 'source-map' : 'cheap-module-eval-source-map',
  devServer: {
    contentBase: path.resolve(__dirname, 'public'),
    headers: {
      'Access-Control-Allow-Origin': '*'
    },
    historyApiFallback: true,
    compress: true,
    noInfo: true,
    quiet: true,
    port: devServerPort
  }
}

let plugins = []

if (production) {
  plugins = [
    new BundleAnalyzerPlugin()
  ]
}

module.exports.plugins.push(...plugins)
