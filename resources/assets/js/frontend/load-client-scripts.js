import 'slick-carousel'
import 'intl-tel-input'
import 'pwstrength-bootstrap/dist/pwstrength-bootstrap'
import 'cookieconsent'
import swal from 'sweetalert2'
import WebFont from 'webfontloader'

window.swal = swal

/**
 * Font
 */
WebFont.load({
  google: {
    families: ['Roboto']
  }
})

/**
 * Cookie Consent
 */
window.addEventListener('load', () => {
  window.cookieconsent.initialise({
    'palette': {
      'popup': {
        'background': '#fff',
        'text': '#777'
      },
      'button': {
        'background': '#3097d1',
        'text': '#ffffff'
      }
    },
    'showLink': false,
    'theme': 'edgeless',
    'content': {
      'message': window.settings.cookieconsent.message,
      'dismiss': window.settings.cookieconsent.dismiss
    }
  })
})
