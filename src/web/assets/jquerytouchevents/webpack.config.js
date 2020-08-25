/* jshint esversion: 6 */
/* globals module, require, __dirname */
const merge = require('webpack-merge');
const decache = require('decache');
decache('../../../../webpack.base.asset.config');
const BASE_CONFIG = require('../../../../webpack.base.asset.config');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const NODE_MODULES = __dirname + '/../../../../node_modules/';

module.exports = merge(BASE_CONFIG, {
    entry: {'entry': './entry.js'},
    plugins: [
        new CopyWebpackPlugin({
            patterns: [
                {
                    context: NODE_MODULES + '/@benmajor/jquery-touch-events/src',
                    from: 'jquery.mobile-events.min.js',
                    to: 'jquery.mobile-events.js',
                },
            ],
        }),
    ]
});