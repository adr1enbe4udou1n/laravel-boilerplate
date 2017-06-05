
require('./../bootstrap');
require('./../plugins');

require('icheck');
require('admin-lte');

// Vue

window.Vue = require('vue');

const app = new Vue({
    el: '#app'
});

$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });

    $(this).find('input').on('ifChecked', function(event) {
        $(this).trigger('change');
    });
});