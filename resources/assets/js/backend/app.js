
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

    console.log(window.settings.ajaxUrls.routeSearch);

    $('.select2-routes').select2({
        minimumInputLength: 2,
        width: '100%',
        ajax: {
            url: window.settings.ajaxUrls.routeSearch,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    middleware: 'metas'
                };
            },
            processResults: function (data, params) {
                return {
                    results: $.map(data, function (item, key) {
                        return {
                            text: item.uri,
                            id: key
                        }
                    })
                };
            },
            cache: true
        }
    });
});