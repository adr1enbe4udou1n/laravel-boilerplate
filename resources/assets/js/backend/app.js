require('./../bootstrap');
require('icheck');
require('admin-lte');
require('./../plugins');

$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });

    $(this).find('input').on('ifChecked', function(event) {
        $(this).trigger('change');
    });

    $('.radio-toggle').each(function() {
        var targets = [];

        $(this).find('input').each(function () {
            var target = $(this).data('target');
            targets.push($(this).data('target'));

            if ($(this).is(':checked')) {
                $(target).show();
            }
        });

        $(this).find('input').change(function(event) {
            $.each(targets, function (index, value) {
                $(value).hide();
            });

            var target = $(this).data('target');
            $(target).fadeIn();
        });
    });
});