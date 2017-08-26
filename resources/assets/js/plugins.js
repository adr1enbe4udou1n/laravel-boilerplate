import i18next from 'i18next'

import 'intl-tel-input'
import 'pwstrength-bootstrap/dist/pwstrength-bootstrap'

import toastr from 'toastr'
import sweetalert2 from 'sweetalert2'
import flatpickr from 'flatpickr'

window.toastr = toastr
window.swal = sweetalert2;

/**
 * Place any jQuery/helper plugins in here.
 */
(function ($) {
  window.locale = $('html').attr('lang')

  i18next.init({
    lng: window.locale,
    resources: {
      en: {
        translation: require('pwstrength-bootstrap/locales/en.json')
      },
      fr: {
        translation: require('pwstrength-bootstrap/locales/fr.json')
      }
    }
  })

  if (window.locale !== 'en') {
    flatpickr.localize(require(`flatpickr/dist/l10n/${window.locale}`)[window.locale])
  }

  /**
     * Place the CSRF token as a header on all pages for access in AJAX requests
     */
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

  /**
   * Swal confirm dialog
   */
  $.confirmSwal = (target, callback) => {
    window.swal({
      title: $(target).attr('data-trans-title'),
      type: 'warning',
      showCancelButton: true,
      cancelButtonText: $(target).attr('data-trans-button-cancel'),
      confirmButtonColor: '#dd4b39',
      confirmButtonText: $(target).attr('data-trans-button-confirm')
    }).then(
      callback,
      () => {}
    )
  }
})(jQuery)
