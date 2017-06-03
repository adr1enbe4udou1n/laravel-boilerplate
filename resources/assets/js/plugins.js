require('select2');
window.swal = require('sweetalert2');

require('datatables.net');
require('datatables.net-bs');

window.moment = require('moment');
require('bootstrap-slider');

/**
 * Allows you to add data-method="METHOD to links to automatically inject a form
 * with the method on click
 *
 * Example: <a href="{{route('customers.destroy', $customer->id)}}"
 * data-method="delete" name="delete_item">Delete</a>
 *
 * Injects a form with that's fired on click of the link with a DELETE request.
 * Good because you don't have to dirty your HTML with delete forms everywhere.
 */
function addDeleteForms() {
    $('[data-method]').append(function () {
        if (!$(this).find('form').length > 0)
            return "\n" +
                "<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                "   <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                "   <input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" +
                "</form>\n";
        else
            return "";
    })
        .removeAttr('href')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

/**
 * Place any jQuery/helper plugins in here.
 */
(function ($) {

    const locale = $('html').attr('lang');

    /**
     * Place the CSRF token as a header on all pages for access in AJAX requests
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Add the data-method="delete" forms to all delete links
     */
    addDeleteForms();

    /**
     * This is for delete buttons that are loaded via AJAX in datatables, they will not work right
     * without this block of code
     */
    $(document).ajaxComplete(function () {
        addDeleteForms();
    });

    /**
     * Generic confirm form delete using Sweet Alert
     */
    $('body').on('submit', 'form[name=delete_item]', function (e) {
        e.preventDefault();
        let form = this;
        let link = $('a[data-method="delete"]');
        let cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Cancel";
        let confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Yes, delete";
        let title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Warning";

        swal({
            title: title,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonColor: "#dd4b39",
            confirmButtonText: confirm
        }).then(
            function() {
                form.submit();
            },
            function (dismiss) {

            }
        );
    });

    /**
     * Bind all bootstrap tooltips
     */
    $('[data-toggle="tooltip"]').tooltip();

    /**
     * Bind all bootstrap popovers
     */
    $('[data-toggle="popover"]').popover();

    /**
     * This closes the popover when its clicked away from
     */
    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

    /**
     * Datatable config
     */
    if ($.fn.dataTable) {
        let dataTableOptions = {
            lengthMenu: [[5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, "All"]],
        };

        if (locale !== 'en') {
            dataTableOptions = {
                lengthMenu: [[5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, "Tout"]],
                language: {
                    "url": "/i18n/datatables." + locale + ".json"
                }
            };
        }

        $.extend(true, $.fn.dataTable.defaults, dataTableOptions);
    }

    /**
     * Autosubmit
     */
    $('.auto-submit').change(function () {
        $(this).closest("form").submit();
    });

    /**
     * Datetimepicker
     */
    $.fn.datetimepicker = require('eonasdan-bootstrap-datetimepicker');
    $('[data-toggle="datetimepicker"]').datetimepicker({
        locale: locale
    });

    /**
     * Plugins to load after DOM is ready
     */
    $(function() {
        /**
         * Bootstrap tabs nav specific hash manager
         */
        let hash = document.location.hash;
        let tabanchor = $(`.nav-tabs a:first`);

        if (hash) {
            tabanchor = $(`.nav-tabs a[href="${hash}"]`);
        }

        tabanchor.tab('show');

        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        });

        /**
         * Select2
         */
        $('[data-toggle="select2"]').select2({
            width: '100%'
        });

        /**
         * Autocomplete select2
         */
        $('[data-toggle="autocomplete"]').each(function() {
            let itemValue = $(this).data('item-value');
            let itemLabel = $(this).data('item-label');
            let ajaxQuery = $(this).data('ajax-query') || {};

            $(this).select2({
                width: '100%',
                minimumInputLength: $(this).data('minimum-input-length'),
                ajax: {
                    url: $(this).data('ajax-url'),
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        ajaxQuery.q = params.term;
                        return ajaxQuery;
                    },
                    processResults: function (data, params) {
                        return {
                            results: $.map(data.items, function (item, key) {
                                return {
                                    text: item[itemValue],
                                    id: item[itemLabel]
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    });
})(jQuery);
