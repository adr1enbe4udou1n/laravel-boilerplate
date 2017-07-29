require('./../bootstrap');
require('./../plugins');
require('cookieconsent');
require('slick-carousel');

/**
 * Vue
 */
import Vue from 'vue';
require('./../vee-validate');
const i18n = require('./../vue-i18n');

// Components sample
import Panel from '.././components/Panel.vue';
Vue.component('panel', Panel);

// Init
new Vue({
    i18n
}).$mount('#app');

// Font

const WebFont = require('webfontloader');

WebFont.load({
    google: {
        families: ['Roboto']
    }
});

// Slider

$('.slider').removeClass('hidden').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1
});

// Cookie consent

window.addEventListener("load", function () {
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
                "background": "#fff",
                "text": "#777"
            },
            "button": {
                "background": "#3097d1",
                "text": "#ffffff"
            }
        },
        "showLink": false,
        "theme": "edgeless",
        "content": {
            "message": window.settings.cookieconsent.message,
            "dismiss": window.settings.cookieconsent.dismiss
        }
    })
});
