import swal from 'sweetalert2'
import Flatpickr from 'flatpickr'
import FlatpickrLocaleFr from 'flatpickr/dist/l10n/fr'

window.swal = swal
window.Flatpickr = Flatpickr
window.FlatpickrLocaleFr = FlatpickrLocaleFr

/**
 * JS Settings App
 */
let jsonSettings = document.querySelector(
  '[data-settings-selector="settings-json"]'
)
window.settings = jsonSettings ? JSON.parse(jsonSettings.textContent) : {}
