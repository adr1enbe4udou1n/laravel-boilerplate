
require('./../bootstrap');
require('./../plugins');

require('icheck');
require('admin-lte');

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