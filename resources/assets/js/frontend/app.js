
require('./../bootstrap');
require('./../plugins');
require('slick-carousel');

const app = new Vue({
    el: '#app'
});

$('.slider').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1
});
