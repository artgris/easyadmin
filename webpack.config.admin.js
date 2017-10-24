const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

/*---- SCSS / CSS config -----------------------------------------------------------------------*/
const SCSS = {
  context: path.resolve('./web/admin/scss'),
  name: 'scss',
  entry: {
    styles: ['./admin.scss']
  },
  output: {
    filename: 'admin.css',
    path: __dirname + '/web/admin/css'
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {loader: 'css-loader', options: {importLoaders: 1}},
            {loader: 'resolve-url-loader'},
            {loader: 'postcss-loader', options: {
              plugins: (loader) => [
                require('autoprefixer')()
              ]
            }},
            {loader: 'sass-loader'}
          ]
        }),
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin({
      filename: 'admin.css',
      allChunks: true,
    })
  ]
};
/*---- Export -----------------------------------------------------------------------*/
module.exports = [SCSS];