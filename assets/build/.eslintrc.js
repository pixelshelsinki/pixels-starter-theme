module.exports = {
  root: true,
  extends: [
    'airbnb-base',
    'plugin:react/recommended',
  ],
  globals: {
    wp: true,
    WPAPI: true,
    'jest/globals': true,
    twigNamespaces: true,
  },
  env: {
    node: true,
    es6: true,
    amd: true,
    browser: true,
    jquery: true,
    jest: true,
    'cypress/globals': true,
  },
  parserOptions: {
    ecmaFeatures: {
      globalReturn: true,
      generators: false,
      objectLiteralDuplicateProperties: false,
      experimentalObjectRestSpread: true,
      jsx: true,
    },
    ecmaVersion: 2018,
    sourceType: 'module',
  },
  parser: '@babel/eslint-parser',
  plugins: [
    'import',
    'react',
    'react-hooks',
    'jest',
    'cypress',
  ],
  settings: {
    react: {
      version: '16.10.2',
    },
    'import/core-modules': [],
    'import/ignore': [
      'node_modules',
      '\\.(coffee|scss|css|less|hbs|svg|json)$',
    ],
  },
  rules: {
    semi: 0,
    'consistent-return': 0,
    'react/prop-types': 0,
    'react/react-in-jsx-scope': 0,
  },
};
