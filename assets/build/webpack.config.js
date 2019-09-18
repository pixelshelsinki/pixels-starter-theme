'use strict'; // eslint-disable-line

const path                  = require('path');
const TerserPlugin          = require('terser-webpack-plugin');
const StyleLintPlugin       = require('stylelint-webpack-plugin');
const FriendlyErrorsPlugin  = require('friendly-errors-webpack-plugin')

module.exports = (env, argv) =>  ({
    entry: {
        'main': path.resolve(__dirname, '../scripts/main.js'),
        'customizer': path.resolve(__dirname, '../scripts/customizer.js'),
    },
    output: {
        path: path.resolve(__dirname, '../../dist/scripts'),
        filename: '[name].js',
    },
    resolve: {
        modules: ['node_modules', 'web_modules'],
        descriptionFiles: ['package.json'],
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                include: path.resolve(__dirname, '../scripts'),
                exclude: /node_modules/,
                use: [
                  {
                    loader: 'babel-loader',
                    options: {
                      configFile: path.resolve(__dirname, 'babel.config.js')
                    },
                  },
                  {
                    loader: 'eslint-loader',
                    options: {
                      configFile: path.resolve(__dirname, '.eslintrc.js')
                    },
                  },
                ],
            },
            {
                test: /\.(sa|sc|c)ss$/,
                include: path.resolve(__dirname, '../styles'),
                use: [
                  {
                    loader: 'file-loader',
                    options: {
                      name: '../styles/main.css',
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
    ],
    optimization: {
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