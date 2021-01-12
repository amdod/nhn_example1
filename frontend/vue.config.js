module.exports = {
  "indexPath": "/Users/nhn/Sites/nhn_example1/app/Views/frontend/index.html",
  "outputDir": "/Users/nhn/Sites/nhn_example1/public/frontend",
  "publicPath": "/frontend/",
  "devServer": {
    "proxy": {
      "/api": {
        "target": "http://localhost:8080",
        "changeOrigin": true
      }
    }
  },
  "transpileDependencies": [
    "vuetify"
  ]
}