module.exports = {
  root: true,
  parserOptions: {
    parser: 'babel-eslint',
    ecmaVersion: 2017,
    sourceType: 'module'
  },
  env: {
    browser: true,
    jquery: true
  },
  extends: [
    'standard',
    'plugin:vue/essential'
  ],
  rules: {
    'arrow-parens': 'error',
    'generator-star-spacing': 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'prefer-arrow-callback': 'error'
  }
}
