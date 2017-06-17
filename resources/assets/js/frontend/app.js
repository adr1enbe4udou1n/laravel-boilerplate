require('./../bootstrap');
require('./../plugins');
require('./../vue');
require('cookieconsent');
require('slick-carousel');

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
