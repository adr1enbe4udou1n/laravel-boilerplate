module.exports = {
    "extends": "eslint:recommended",
    "env": {
        "browser": true,
        "node": true,
        "commonjs": true,
        "es6": true,
        "jquery": true
    },
    "plugins": [
        "import",
        "vue"
    ],
    "parserOptions": {
        "sourceType": "module"
    },
    "rules": {
        "indent": [
            "error",
            4
        ],
        "quotes": [
            "error",
            "single"
        ],
        "semi": [
            "error",
            "always"
        ]
    }
};
