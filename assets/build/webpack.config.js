'use strict'; // eslint-disable-line

const path              = require('path');
const TerserPlugin      = require('terser-webpack-plugin');

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
                use: argv.mode == 'production' ? [ 'babel-loader' ] : [ 'babel-loader', 'eslint-loader' ],
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