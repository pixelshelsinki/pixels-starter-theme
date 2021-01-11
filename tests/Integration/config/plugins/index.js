module.exports = (on, config) => {
  const projectConfig = config

  /**
   * Add tasks for logging to terminal.
   */
  on('task', {
    log(message) {
      console.log(message) // eslint-disable-line

      return null
    },
    table(message) {
      console.table(message) // eslint-disable-line

      return null
    },
  })

  if (config.env.env === 'test') {
    projectConfig.baseUrl = projectConfig.env.localUrl
  } else {
    projectConfig.baseUrl = projectConfig.env.productionUrl
  }

  return projectConfig
}
