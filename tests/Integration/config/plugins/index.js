module.exports = (on, config) => {
  const projectConfig = config

  if (config.env.env === 'test') {
    projectConfig.baseUrl = projectConfig.env.localUrl
  } else {
    projectConfig.baseUrl = projectConfig.env.productionUrl
  }

  return projectConfig
}
