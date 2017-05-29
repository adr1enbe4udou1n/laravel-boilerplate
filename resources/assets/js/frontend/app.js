
require('./../bootstrap');
require('./../plugins');
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
