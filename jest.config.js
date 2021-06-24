module.exports = {
  testEnvironment: 'jsdom',
  verbose: false,
  transform: {
   '^.+\\.js$': 'babel-jest',
   '\\.svg$': 'svg-jest'
  },
  setupFilesAfterEnv: [
    './setupTests.js'
  ]
}
