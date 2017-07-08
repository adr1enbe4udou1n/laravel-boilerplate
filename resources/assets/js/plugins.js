require('select2');
window.swal = require('sweetalert2');

window.moment = require('moment');

require('flatpickr');
require('intl-tel-input');

require('ckeditor');
require('ckeditor/adapters/jquery');

window.locale = $('html').attr('lang');

/**
 * Place any jQuery/helper plugins in here.
 */
(function ($) {

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
     * Swal confirm dialog
     */
    function confirmSwal(button, form = null) {
        swal({
            title: $(button).attr('data-trans-title'),
            type: "warning",
            showCancelButton: true,
            cancelButtonText: $(button).attr('data-trans-button-cancel'),
            confirmButtonColor: "#dd4b39",
            confirmButtonText: $(button).attr('data-trans-button-confirm')
        }).then(
            function () {
                if (form) {
                    return form.submit();
                }
                $(button).closest('form').submit();
            },
            function (dismiss) {

            }
        );
    }

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

        let link = $('a[data-method="delete"]');
        confirmSwal(link, this);
    });

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
            lengthMenu: [[5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, locale === 'en' ? 'All' : 'Tout']],
            buttons: [
                'csvHtml5', 'excelHtml5'
            ],
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-4 text-center'p><'col-sm-4 text-right'B>>",
        };

        if (locale !== 'en') {
            dataTableOptions['language'] = {
                url: `/i18n/datatables.${locale}.json`
            };
        }

        $.extend(true, $.fn.dataTable.defaults, dataTableOptions);
    }

    /**
     * Plugins to load after DOM is ready
     */
    $(function () {
        /**
         * Bind all bootstrap tooltips
         */
        $('[data-toggle="tooltip"]').tooltip();

        /**
         * Bind all bootstrap popovers
         */
        $('[data-toggle="popover"]').popover();

        /**
         * Autosubmit
         */
        $('.auto-submit').change(function () {
            $(this).closest("form").submit();
        });

        /**
         * Submit support for dropdown buttons
         */
        $('[data-toggle="submit-link"]').click(function () {
            let $form = $(this).closest('form');
            $form.find($(this).data('target')).val($(this).data('value'));
            $form.submit();
        });

        /**
         * HTML editor with ckeditor
         */
        $('[data-toggle="editor"]').each(function () {
            let plugins = ['autogrow', 'image2'];

            let uploadUrl = $(this).data('upload-url');
            if (uploadUrl) {
                plugins.push('uploadimage')
            }

            $(this).ckeditor({
                extraPlugins: plugins.join(','),
                removePlugins: 'resize',
                language: locale,
                toolbar: [
                    {name: 'basicstyles', items: ['Bold', 'Italic']},
                    {name: 'links', items: ['Link', 'Unlink']},
                    {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
                    {name: 'insert', items: ['Blockquote', 'Image']},
                    {name: 'styles', items: ['Format']},
                    {name: 'document', items: ['Source']},
                ],
                uploadUrl: uploadUrl,
                autoGrow_minHeight: 200,
                autoGrow_maxHeight: 600,
                autoGrow_onStartup: true
            });
        });

        /**
         * Bind all swal confirm buttons
         */
        $('[data-toggle="confirm"]').click(function (e) {
            e.preventDefault();
            confirmSwal(e.target);
        });

        /**
         * Bulk forms
         */
        $('[data-toggle="bulk-form"]').submit(function (e) {
            let $form = $(this);
            $form.find('[name="ids[]"]').remove();

            let dataTableId = $(this).data('target');
            let dataTable = $(dataTableId).DataTable();

            $.each(dataTable.rows({selected: true}).ids(), function (index, value) {
                let input = $('<input>').attr({
                    'type': 'hidden',
                    'name': 'ids[]'
                }).val(value);
                $form.prepend(input);
            });
        });

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
        $('[data-toggle="select2"]').each(function () {
            $(this).select2({
                width: '100%'
            });
        });

        /**
         * Autocomplete select2
         */
        $('[data-toggle="autocomplete"]').each(function () {
            let itemValue = $(this).data('item-value');
            let itemLabel = $(this).data('item-label');

            $(this).select2({
                width: '100%',
                minimumInputLength: $(this).data('minimum-input-length'),
                ajax: {
                    url: $(this).data('ajax-url'),
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: $.map(data.items, function (item, key) {
                                return {
                                    id: item[itemValue],
                                    text: item[itemLabel],
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        $('[type="tel"]').intlTelInput({
            autoPlaceholder: 'aggressive',
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js',
            initialCountry: locale === 'en' ? 'us' : locale,
            preferredCountries: ['us', 'gb', 'fr']
        });
    });
})(jQuery);
