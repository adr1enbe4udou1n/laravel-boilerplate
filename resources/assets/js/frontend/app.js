require('./../bootstrap');
require('./../plugins');
require('cookieconsent');
require('slick-carousel');

// Font

const WebFont = require('webfontloader');

WebFont.load({
    google: {
        families: ['Roboto']
    }
});

// Vue

window.Vue = require('vue');

Vue.component('panel', require('./components/Panel.vue'));

const app = new Vue({
    el: '#app'
});

// Slider

$('.slider').slick({
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
                "background": "#2a2730",
                "text": "#ffffff"
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
