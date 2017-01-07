
require('./../bootstrap');
require('./../plugins');
require('swiper');

const app = new Vue({
    el: '#app'
});

let swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    paginationClickable: true
});
