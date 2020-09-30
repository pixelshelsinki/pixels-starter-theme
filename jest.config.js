module.exports = {
  testEnvironment: 'jsdom',
  verbose: false,
  transform: {
   '^.+\\.js$': 'babel-jest',
   '^.+\\.svg$': 'jest-svg-transformer'
  },
  setupFilesAfterEnv: [
    './setupTests.js'
  ]
}
