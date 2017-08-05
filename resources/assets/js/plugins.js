
window.locale = $('html').attr('lang');

import i18next from 'i18next';

window.i18next = i18next.init({
    lng: locale,
    resources: {
        en: {
            translation: require('pwstrength-bootstrap/locales/en.json')
        },
        fr: {
            translation: require('pwstrength-bootstrap/locales/fr.json')
        }
    }
});

const flatpickr = require('flatpickr');

if (locale !== 'en') {
    flatpickr.localize(require(`flatpickr/dist/l10n/${locale}`)[locale]);
}

require('select2');
require('intl-tel-input');
require('pwstrength-bootstrap/dist/pwstrength-bootstrap');

window.toastr = require('toastr');
window.swal = require('sweetalert2');

/**
 * Place any jQuery/helper plugins in here.
 */
(function ($) {

    /**
     * Place the CSRF token as a header on all pages for access in AJAX requests
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Swal confirm dialog
     */
    $.confirmSwal = function (target, callback) {
        swal({
            title: $(target).attr('data-trans-title'),
            type: "warning",
            showCancelButton: true,
            cancelButtonText: $(target).attr('data-trans-button-cancel'),
            confirmButtonColor: "#dd4b39",
            confirmButtonText: $(target).attr('data-trans-button-confirm')
        }).then(
            callback,
            function (dismiss) {}
        );
    };

    /**
     * Datatable config
     */
    if ($.fn.dataTable) {
        let dataTableOptions = {
            lengthMenu: [[5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, locale === 'en' ? 'All' : 'Tout']],
            buttons: [
                'csvHtml5', 'excelHtml5'
            ],
            dom:
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p><'col-sm-12 col-md-4 text-right'B>>",
        };

        if (locale !== 'en') {
            dataTableOptions['language'] = {
                url: `/i18n/datatables.${locale}.json`
            };
        }

        $.extend(true, $.fn.dataTable.defaults, dataTableOptions);

        $.extend($.fn.dataTable.ext.classes, {
            sWrapper:      "dataTables_wrapper dt-bootstrap4",
            sFilterInput:  "form-control input-sm",
            sLengthSelect: "form-control input-sm",
            sProcessing:   "dataTables_processing panel panel-default",
            sPageButton:   "paginate_button page-item"
        });
    }

    /**
     * This is for delete buttons that are loaded via AJAX in datatables, they will not work right
     * without this block of code
     */
    $(document).ajaxComplete(function () {
        $('[data-toggle="delete-row"]').click(function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let dataTable = $(this).closest('table').DataTable();

            $.confirmSwal(this, () => {
                axios.delete(url)
                    .then(response => {
                        // Reload Datatables and keep current pager
                        dataTable.ajax.reload(null, false);
                        toastr[response.data.status](response.data.message);
                    })
                    .catch(error => {
                            toastr.error(error.response.data.error);
                        }
                    );
            });
        });
    });

    $.initPlugins = function () {
        /**
         * Bind all bootstrap tooltips
         */
        $('[data-toggle="tooltip"]').tooltip();

        /**
         * Bind all bootstrap popovers
         */
        $('[data-toggle="popover"]').popover();

        /**
         * Submit support for dropdown buttons
         */
        $('[data-toggle="submit-link"]').click(function () {
            let $form = $(this).closest('form');
            $form.find($(this).data('target')).val($(this).data('value'));
            $form.submit();
        });

        /**
         * Bind all swal confirm buttons
         */
        $('[data-toggle="confirm"]').click(function (e) {
            e.preventDefault();

            $.confirmSwal(e.target, function () {
                $(e.target).closest('form').submit();
            });
        });

        $('[data-toggle="password-strength-meter"]').each(function () {
            $(this).pwstrength({
                ui: {
                    bootstrap4: true
                }
            });
        });

        /**
         * Select2
         */
        $('[data-toggle="select2"]').each(function () {
            $(this).select2({
                width: '100%',
                theme: "bootstrap"
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
                theme: "bootstrap",
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
    };

    /**
     * Plugins to load after DOM is ready
     */
    $(function () {
        $.initPlugins();
    });
})(jQuery);
