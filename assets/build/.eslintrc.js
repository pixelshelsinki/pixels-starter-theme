module.exports = {
  'root': true,
  'extends':  [
    'eslint:recommended',
    'plugin:react/recommended'
  ],
  'globals': {
    'wp': true,
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
    'ecmaVersion': 2017,
    'sourceType': 'module',
  },
  'plugins': [
    'import',
    'react',
    'react-hooks',
  ],
  'settings': {
    'import/core-modules': [],
    'import/ignore': [
      'node_modules',
      '\\.(coffee|scss|css|less|hbs|svg|json)$',
    ],
  },
  'rules': {
    'react/prop-types': 0,
    'no-console': 0,
    'quotes': ['error', 'single'],
    'comma-dangle': [
      'error',
      {
        'arrays': 'always-multiline',
        'objects': 'always-multiline',
        'imports': 'always-multiline',
        'exports': 'always-multiline',
        'functions': 'ignore',
      },
    ],
  },
};
