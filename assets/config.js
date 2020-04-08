const config = {
  urls : {
    devUrl: 'https://startertheme.local',
    devHost : 'localhost',
    devPort: 3000,
  },
  paths : {
    src : {
      scripts : '../scripts',
      styles : '../styles',
      fonts : '../fonts',
      images : '../images',
    },
    dist : {
      root : '../../dist/',
      fonts : '../../dist/fonts',
      images : '../../dist/images',
    },    
  }
}

module.exports = config