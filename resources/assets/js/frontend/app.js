
require('./../bootstrap');
require('flexslider');
require('./../plugins');

const app = new Vue({
    el: '#app'
});

$('.flexslider').flexslider({
    animation: "slide"
});
