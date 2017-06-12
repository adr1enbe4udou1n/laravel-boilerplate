
require('./../bootstrap');

window.JSZip = require('jszip');

// Datatables
require('datatables.net');
require('datatables.net-bs');
require('datatables.net-select');
require('datatables.net-buttons');
require('datatables.net-buttons/js/buttons.html5');
require('datatables.net-buttons-bs');

// Plugins
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