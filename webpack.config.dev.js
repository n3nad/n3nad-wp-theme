const merge = require('webpack-merge')
const baseConfig = require('./webpack.config.base')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
require('dotenv').config()

module.exports = merge(baseConfig, {
  mode: 'development',
  plugins: [
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 3000,
      proxy: process.env.WP_URL,
      files: './**/*.php'
    })
  ],
  devtool: 'source-map'
})
