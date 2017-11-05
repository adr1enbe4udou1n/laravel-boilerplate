import './../bootstrap'
import './load-client-scripts'

/**
 * Vue
 */
import Vue from 'vue'
import { createLocales } from '../vue-i18n'
import VeeValidate from '../vee-validate'
import Panel from '../components/Panel'

// eslint-disable-next-line no-unexpected-multiline
(($) => {
  window.locale = $('html').attr('lang')

  /**
   * Place the CSRF token as a header on all pages for access in AJAX requests
   */
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

  /**
   * Slick
   */
  $('[data-toggle="slider"]')
    .not('.slick-initialized')
    .slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    })

  /**
   * Bind all bootstrap tooltips
   */
  $('[data-toggle="tooltip"]').tooltip()

  /**
   * Bind all bootstrap popovers
   */
  $('[data-toggle="popover"]').popover()

  /**
   * Bind all swal confirm buttons
   */
  $('[data-toggle="confirm"]').click((e) => {
    e.preventDefault()

    window.swal({
      title: $(e.currentTarget).attr('data-trans-title'),
      type: 'warning',
      showCancelButton: true,
      cancelButtonText: $(e.currentTarget).attr('data-trans-button-cancel'),
      confirmButtonColor: '#dd4b39',
      confirmButtonText: $(e.currentTarget).attr('data-trans-button-confirm')
    }).then(
      () => {
        $(e.target).closest('form').submit()
      },
      () => {}
    )
  })

  $('[data-toggle="password-strength-meter"]').pwstrength({
    ui: {
      bootstrap4: true
    }
  })

  $('[type="tel"]').intlTelInput({
    autoPlaceholder: 'aggressive',
    utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js',
    initialCountry: window.locale === 'en' ? 'us' : window.locale,
    preferredCountries: ['us', 'gb', 'fr']
  })

  /**
   * Bootstrap tabs nav specific hash manager
   */
  let hash = document.location.hash
  let tabanchor = $('.nav-tabs a:first')

  if (hash) {
    tabanchor = $(`.nav-tabs a[href="${hash}"]`)
  }

  tabanchor.tab('show')

  $('a[data-toggle="tab"]').on('show.bs.tab', (e) => {
    window.location.hash = e.target.hash
  })
})(jQuery)

/**
 * Vue
 */
VeeValidate(window.locale)

Vue.component('panel', Panel)

export function createApp () {
  const i18n = createLocales(window.locale)

  const app = new Vue({
    i18n
  })

  return { app }
}

// Init App
const { app } = createApp()
app.$mount('#app')
