const path = require('path');

module.exports = {
  entry: {
    index: './public/index.jsx',
    index2: './public/index2.jsx'
  },
  output: {
    filename: '[name].bundle.js', // Use [name] placeholder to name the bundles according to the entry point
    path: path.resolve(__dirname, 'public', 'bundles'), // Make sure 'public' and 'bundles' directories exist
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/, // Handles both .js and .jsx files
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /\.(png|jpe?g|gif|mp3|ogg|wav)$/i,
        loader: 'file-loader',
        options: {
          outputPath: 'assets',
        },
      },
    ],
  },
  resolve: {
    extensions: ['.js', '.jsx'], // Add '.jsx' to the list of extensions
  },
};
