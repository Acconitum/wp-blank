const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
  entry: './wp-content/themes/##replace##/assets/js/app.js',
  output: {
    path: path.resolve(__dirname, 'wp-content/themes/##replace##/assets/dist'),
    filename: 'app.min.js'
  },
  optimization: {
    minimizer: [new TerserPlugin()]
  }
};