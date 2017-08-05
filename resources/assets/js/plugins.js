
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
})(jQuery);
