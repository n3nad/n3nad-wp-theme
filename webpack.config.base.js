const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

module.exports = {
  entry: {
    blocks: path.resolve(__dirname, 'js/blocks/blocks.js'),
  },
  output: {
    path: path.join(__dirname, 'build'),
    publicPath: `/wp-content/themes/opin-kerfi/build/`,
    filename: '[name].js',
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        loader: ['babel-loader'],
        exclude: modulePath => /node_modules/.test(modulePath),
      },
      {
        test: /\.s?css$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
        exclude: /node_modules/,
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
    }),
  ],
  resolve: {
    modules: [path.resolve(__dirname, 'js'), 'node_modules'],
    extensions: ['.js', '.jsx', '.json'],
  },
}
