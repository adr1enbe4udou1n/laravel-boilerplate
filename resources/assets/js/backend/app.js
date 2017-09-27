
import './../bootstrap'

// Datatables
import 'datatables.net'
import 'datatables.net-bs4'
import 'datatables.net-select'
import 'datatables.net-buttons'
import 'datatables.net-buttons-bs4'
import 'datatables.net-responsive'
import 'datatables.net-responsive-bs4'
import 'datatables.net-buttons/js/buttons.html5'

import sweetalert2 from 'sweetalert2'

/**
 * Vue
 */
import Vue from 'vue'
import VueI18n from '../vue-i18n'
import VeeValidate from '../vee-validate'
import vSelect from 'vue-select'
import FormFieldset from '.././components/FormFieldset.vue'
import InputGroup from '.././components/InputGroup.vue'
import FormCheckbox from '.././components/FormCheckbox.vue'
import FormRadio from '.././components/FormRadio.vue'
import FormToggle from '.././components/FormToggle.vue'
import Tooltip from '.././components/Tooltip.vue'
import Flatpickr from '.././components/Flatpickr.vue'
import CKEditor from '.././components/CKEditor.vue'
import DataTable from './components/DataTable.vue'
import BatchAction from './components/BatchAction.vue'
import Router from './router'
import App from './App.vue'

window.swal = sweetalert2
window.locale = $('html').attr('lang')

const i18n = VueI18n(window.locale)

// VeeValidate
VeeValidate(window.locale)

// vue-select
Vue.component('v-select', vSelect)

// Custom components
Vue.component('b-form-fieldset', FormFieldset)
Vue.component('b-input-group', InputGroup)
Vue.component('b-form-checkbox', FormCheckbox)
Vue.component('b-form-radio', FormRadio)
Vue.component('b-form-toggle', FormToggle)
Vue.component('b-tooltip', Tooltip)
Vue.component('flatpickr', Flatpickr)
Vue.component('ckeditor', CKEditor)
Vue.component('datatable', DataTable)
Vue.component('batch-action', BatchAction)

let router = Router(i18n)

router.beforeEach((to, from, next) => {
  document.title = `${to.meta.title} | ${window.settings.appName}`
  next()
})

Vue.prototype.$app = window.settings
Vue.prototype.$app.route = window.route

if (Vue.prototype.$app.user) {
  Vue.prototype.$app.user.can = (permission) => {
    if (Vue.prototype.$app.user.id === 1 ||
      Vue.prototype.$app.permissions.includes('access all backend')) {
      return true
    }
    return Vue.prototype.$app.permissions.includes(permission)
  }
}

// Init
if (document.getElementById('app') !== null) {
  new Vue({
    i18n,
    router,
    template: '<App/>',
    components: {App}
  }).$mount('#app')
}
