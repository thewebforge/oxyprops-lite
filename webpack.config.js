// webpack.config.js
const path = require("path")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")

module.exports = {
  entry: {
    frontend: './src/js/frontend.js',
    backend: './src/js/backend.js',
    normalize: './src/js/normalize.js',
    dashboard: './src/js/dashboard.js',
    openProps: './src/js/open-props.js',
  },
  output: {
    filename: "[name].js",
    path: path.resolve(__dirname, "assets/js"),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: "babel-loader",
        options: {
          presets: ["@babel/preset-env"],
        },
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [MiniCssExtractPlugin.loader,
            'css-loader',
            'postcss-loader',
            'sass-loader'],
      },
      {
        test: /\.(gif|png|jpe?g)$/i,
        use: [
          {
            loader: "url-loader",
            options: {
              limit: 8192, // Files smallers than 8k embed.
              name: "[name].[ext]", // Files bigger than 8k compress.
              outputPath: "../images",
            },
          },
          {
            loader: "image-webpack-loader",
            options: {
              disable: process.env.NODE_ENV == "development",
              mozjpeg: { quality: 50 },
              pngquant: { quality: [0.5, 0.7] },
            },
          },
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "../css/[name].min.css", // Relative to output path.
      chunkFilename: "[id].css",
    }),
  ],
}