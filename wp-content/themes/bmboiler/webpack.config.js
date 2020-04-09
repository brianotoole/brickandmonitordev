var ExtractText = require("extract-text-webpack-plugin");
var BrowserSyncPlugin = require("browser-sync-webpack-plugin");

var config = {
  entry: {
    main: "./src/js/main.js",
    blog: "./src/js/blog.js",
    //admin: "./src/js/admin.js",
    blog_vue: "./src/js/blog-vue.js",
    //slider: "./src/js/slider.js",
    jquery_plugins: "./src/js/jquery-plugins.js"
  },
  output: {
    filename: "js/[name].js",
    path: __dirname + "/dist"
  },
  // entry: ['./src/js/main.js', './src/scss/main.scss'],
  // output: {
  //   filename: 'js/[name].js',
  //   publicPath: '../../'
  // },
  module: {
    rules: [
      {
        // STYLE LOADERS
        test: /\.(css|sass|scss)$/,
        use: ExtractText.extract({
          use: ["css-loader", "postcss-loader", "sass-loader"]
        })
      },
      {
        // SCRIPT LOADERS
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        loader: "babel-loader",
        query: {
          presets: ["env"]
        }
      },
      {
        // URL LOADER, IMAGE FILES
        test: /\.(jpe?g|png)/,
        loader: "url-loader?limit=10000&name=dist/img/[name].[ext]" //if < 10 kb, base64 encode img to css
      },
      {
        // URL LOADER, FONT FILES
        test: /\.(woff|woff2|eot|ttf|svg)/,
        loader: "url-loader?limit=10000&name=dist/fonts/[name].[ext]" //font files to './dist/fonts/**.'
      }
    ]
  },
  plugins: [
    require("tailwindcss"),
    require("autoprefixer"),
    new ExtractText({
      filename: "css/[name].css",
      allChunks: true
    })
  ]
};

module.exports = config;
