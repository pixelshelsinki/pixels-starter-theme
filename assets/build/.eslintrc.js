module.exports = {
  'root': true,
  'extends':  [
    'airbnb-base',
    'plugin:react/recommended'
  ],
  'globals': {
    'wp': true,
    'WPAPI': true,
  },
  'env': {
    'node': true,
    'es6': true,
    'amd': true,
    'browser': true,
    'jquery': true,
  },
  'parserOptions': {
    'ecmaFeatures': {
      'globalReturn': true,
      'generators': false,
      'objectLiteralDuplicateProperties': false,
      'experimentalObjectRestSpread': true,
      'jsx': true,
    },
    'ecmaVersion': 2018,
    'sourceType': 'module',
  },
  'parser': 'babel-eslint',
  'plugins': [
    'import',
    'react',
    'react-hooks',
  ],
  'settings': {
    'react': {
      'version': '16.10.2',
    },
    'import/core-modules': [],
    'import/ignore': [
      'node_modules',
      '\\.(coffee|scss|css|less|hbs|svg|json)$',
    ],
  },
  'rules': {
    'semi': 0,
    'no-console': 0,
    'consistent-return' : 0,
    'react/prop-types': 0,
    'react/react-in-jsx-scope': 0,
  },
};
