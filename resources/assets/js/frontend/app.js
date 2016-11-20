
require('./../bootstrap');
require('./../plugins');
require('flexslider');

const app = new Vue({
    el: '#app'
});

$('.flexslider').flexslider({
    animation: "slide"
});
