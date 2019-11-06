'use strict'; // eslint-disable-line

// Webpack tools.
const path                   = require('path');
const TerserPlugin           = require('terser-webpack-plugin');
const StyleLintPlugin        = require('stylelint-webpack-plugin');
const FriendlyErrorsPlugin   = require('friendly-errors-webpack-plugin')
const CopyWebpackPlugin      = require('copy-webpack-plugin')
const BrowserSyncPlugin      = require('browser-sync-webpack-plugin')
const ManifestPlugin         = require('webpack-manifest-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

// Our asset config.
const config                = require('../config')

module.exports = (env, argv) =>  ({
    entry: {
        'scripts/main': path.resolve(__dirname, '../scripts/main.js'),
        'scripts/customizer': path.resolve(__dirname, '../scripts/customizer.js'),
    },
    output: {
        path: path.resolve(__dirname, config.paths.dist.root),
        filename: '[name].[contenthash].js',
    },
    resolve: {
        modules: ['node_modules', 'web_modules'],
        descriptionFiles: ['package.json'],
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                include: path.resolve(__dirname, config.paths.src.scripts),
                exclude: /node_modules/,
                use: [
                  {
                    loader: 'babel-loader',
                    options: {
                      configFile: path.resolve(__dirname, 'babel.config.js'),
                    },
                  },
                  {
                    loader: 'eslint-loader',
                    options: {
                      configFile: path.resolve(__dirname, '.eslintrc.js'),
                    },
                  },
                ],
            },
            {
                test: /\.(sa|sc|c)ss$/,
                include: path.resolve(__dirname, config.paths.src.styles),
                use: [
                  {
                    loader: 'file-loader',
                    options: {
                      name: 'main.[contenthash].css',
                      outputPath: config.paths.dist.styles,
                    },
                  },
                  {
                      loader: 'extract-loader',
                  },
                  {
                      loader: 'css-loader?-url',
                  },
                  {
                      loader: 'postcss-loader',
                      options: {
                        config: {
                          path: path.resolve(__dirname),
                        },
                      },
                  },
                  {
                      loader: 'sass-loader',
                  },
                ],
            },
        ],
    },
    plugins: [      
      new FriendlyErrorsPlugin(),
      new StyleLintPlugin({
        configFile: path.resolve(__dirname, '.stylelintrc.js'),
      }),
      new ManifestPlugin(
        {
          fileName: "manifest.json",
          filter: (file) => !file.path.match(/\.svg|png|jpg|js.LICENSE$/),
        }
      ),
      new CopyWebpackPlugin([
          {
            from: path.resolve(__dirname, config.paths.src.fonts),
            to: path.resolve(__dirname, config.paths.dist.fonts),
            ignore: ['.gitkeep', '.DS_Store'],
          },
          {
            from: path.resolve(__dirname, config.paths.src.images),
            to: path.resolve(__dirname, config.paths.dist.images),
            ignore: ['.gitkeep', '.DS_Store'],
          },
      ]),
      new BrowserSyncPlugin(
        {
          host: config.urls.devHost,
          port: config.urls.devPort,
          proxy: config.urls.devUrl,
        },
      ),
      new CleanWebpackPlugin(),
    ],
    optimization: {
        splitChunks: {
          chunks: 'all',
        },
        minimize: argv.mode == 'production' ? true : false,
        minimizer: argv.mode == 'production' ? [
            new TerserPlugin( {
                terserOptions: { 
                    output: { 
                        comments: false,
                    },
                },
            }),
        ] : [],
    },
    externals: {
        jQuery: 'jQuery',      
        $: 'jQuery',
    },
    watch: argv.mode == 'production' ? false : true,
    watchOptions: {
        ignored: ['node_modules'],
    },
});