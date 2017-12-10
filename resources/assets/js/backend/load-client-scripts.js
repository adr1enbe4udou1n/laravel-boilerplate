import 'datatables.net'
import 'datatables.net-bs4'
import 'datatables.net-select'
import 'datatables.net-buttons'
import 'datatables.net-buttons-bs4'
import 'datatables.net-responsive'
import 'datatables.net-responsive-bs4'
import 'datatables.net-buttons/js/buttons.html5'

import Flatpickr from 'flatpickr'
import FlatpickrLocaleFr from 'flatpickr/dist/l10n/fr'

import 'pwstrength-bootstrap/dist/pwstrength-bootstrap'
import swal from 'sweetalert2'
import toastr from 'toastr'

import Quill from 'quill'

window.swal = swal
window.toastr = toastr
window.Flatpickr = Flatpickr
window.FlatpickrLocaleFr = FlatpickrLocaleFr
window.Quill = Quill

/**
 * JS Settings App
 */
let jsonSettings = $('[data-settings-selector="settings-json"]').text()
window.settings = jsonSettings ? JSON.parse(jsonSettings) : {}
