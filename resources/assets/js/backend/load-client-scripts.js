import Flatpickr from 'flatpickr'
import FlatpickrLocaleFr from 'flatpickr/dist/l10n/fr'

import 'pwstrength-bootstrap/dist/pwstrength-bootstrap'
import swal from 'sweetalert2'
import toastr from 'toastr'

window.swal = swal
window.toastr = toastr
window.Flatpickr = Flatpickr
window.FlatpickrLocaleFr = FlatpickrLocaleFr

/**
 * JS Settings App
 */
let jsonSettings = $('[data-settings-selector="settings-json"]').text()
window.settings = jsonSettings ? JSON.parse(jsonSettings) : {}
