module.exports = (on, config) => {

  if( config.env.env == 'test' ) {
    config.baseUrl = config.env.localUrl
  } else {
    config.baseUrl = config.env.productionUrl
  }

  return config
}
