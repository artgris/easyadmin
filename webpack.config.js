const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const Bs = require('browser-sync');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const isDev = process.env.NODE_ENV === 'dev';

/*---- Javascript config -----------------------------------------------------------------------*/
const JS = {
  name: 'js',
  context: path.resolve('./front/js/'),
  watch: isDev,
  entry: {
    main: './main.js'
  },
  output: {
    filename: '[name].js',
    chunkFilename: '[name].bundle.js',
    path: __dirname + '/web/build/js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: [{
          loader: 'babel-loader',
        }],
      }
    ]
  },
  plugins: [
    new BrowserSyncPlugin({
      // browse to http://localhost:3000/app_dev.php during development,
      // ./web directory is being served
      proxy: 'yourproject.dev/app_dev.php',
      server: { baseDir: ['web'] },
      files: ['./**/*.html.twig', './*/**.css', './build/js/**/*.js']
    })
  ]
};

/*---- SCSS / CSS config -----------------------------------------------------------------------*/
const SCSS = {
  context: path.resolve('./front/scss/'),
  name: 'scss',
  watch: isDev,
  entry: {
    styles: ['./style.scss']
  },
  output: {
    filename: 'style.css',
    path: __dirname + '/web/build/css'
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {loader: 'css-loader', options: {importLoaders: 1, minimize: !isDev}},
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
      filename: 'style.css',
      allChunks: true,
    })
  ]
};

/*---- For production -----------------------------------------------------------------------*/
if (!isDev) {
  JS.plugins.push(new UglifyJsPlugin());
  JS.plugins.push(new CleanWebpackPlugin(['web/build/js'], { // remove ./dist/js
    root: path.resolve('./'),
    verbose: true,
    dry: true,
  }));
  SCSS.plugins.push(new UglifyJsPlugin());
  SCSS.plugins.push(new CleanWebpackPlugin(['web/build/css'], { // remove ./dist/css
    root: path.resolve('./'),
    verbose: true,
    dry: true,
  }));
}

/*---- Export -----------------------------------------------------------------------*/
module.exports = [JS, SCSS];
