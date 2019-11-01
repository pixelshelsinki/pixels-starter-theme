const config = {
  urls : {
    devUrl: 'https://theme.local',
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
      scripts : '../../dist/scripts',
      styles : '../styles',
      fonts : '../../dist/fonts',
      images : '../../dist/images',
    },    
  }
}

module.exports = config