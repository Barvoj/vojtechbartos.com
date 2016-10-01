var path = require('path');
var webpack = require('webpack');
var ExtractTextPlugin = require("extract-text-webpack-plugin");

var extractLESS = new ExtractTextPlugin('style.css');

module.exports = {
    cache: true,
    entry: path.join(__dirname, 'resources/js/script.jsx'),
    output: {
        path: path.join(__dirname, 'www/dist'),
        publicPath: '/dist/',
        filename: "script.js"
    },
    module: {
        loaders: [
            {
                test: /.jsx?$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                query: {
                    presets: ['es2015', 'react']
                }
            },
            {
                test: /\.(css|less)$/,
                loader: extractLESS.extract("style-loader", "css-loader!less-loader")
            },
            {
                test: /\.png$/,
                loader: "url-loader?limit=100000"
            },
            {
                test: /\.jpg$/,
                loader: "file-loader"
            },
            {
                test: /\.(woff|woff2)(\?v=\d+\.\d+\.\d+)?$/,
                loader: "url?prefix=font/&limit=5000&name=[hash].[ext]"
            },
            {
                test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
                loader: "url?limit=10000&mimetype=application/octet-stream&name=[hash].[ext]"
            },
            {
                test: /\.eot(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'file?name=[hash].[ext]'
            },
            {
                test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
                loader: "url?limit=10000&mimetype=image/svg+xml&name=[hash].[ext]"
            }
        ]
    },
    plugins: [
        extractLESS,
        new webpack.ProvidePlugin({
            "window.jQuery": "jquery",
            jQuery: "jquery",
            $: "jquery"
        })
    ]
};