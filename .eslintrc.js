module.exports = {
  root: true,
  parserOptions: {
    parser: 'babel-eslint',
  },
  env: {
    browser: true,
    jquery: true
  },
  extends: [
    'plugin:vue/recommended',
    'standard'
  ],
  plugins: [
    'vue'
  ],
  rules: {
    'arrow-parens': 'error',
    'generator-star-spacing': 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'prefer-arrow-callback': 'error',
    'vue/max-attributes-per-line': 'off',
    'vue/attributes-order': 'off',
    'vue/html-self-closing': ['error', {
      html: {
        void: 'never',
        normal: 'never',
        component: 'never'
      },
      svg: 'never',
      math: 'never'
    }]
  }
}
