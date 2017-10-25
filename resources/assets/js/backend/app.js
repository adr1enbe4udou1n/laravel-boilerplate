
/**
 * Axios
 */
import axios from 'axios'

/**
 * Datatable
 */
import 'datatables.net'
import 'datatables.net-bs4'
import 'datatables.net-select'
import 'datatables.net-buttons'
import 'datatables.net-buttons-bs4'
import 'datatables.net-responsive'
import 'datatables.net-responsive-bs4'
import 'datatables.net-buttons/js/buttons.html5'

/**
 * Vue
 */
import Vue from 'vue'
import VueI18n from '../vue-i18n'
import VeeValidate from '../vee-validate'
import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm'
import vSelect from 'vue-select'

// CoreUI components
import Switch from './components/Switch'

// Vendor plugins components
import DataTable from './components/plugins/DataTable'
import CKEditor from './components/plugins/CKEditor'
import Flatpickr from './components/plugins/Flatpickr'

import Router from './router'
import App from './App.vue'

/**
 * Axios CSRF init
 */
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
}

/**
 * JS Settings App
 */
let jsonSettings = $('[data-settings-selector="settings-json"]').text()
let settings = jsonSettings ? JSON.parse(jsonSettings) : {}

const i18n = VueI18n(settings.locale)
VeeValidate(settings.locale)

// Bootstrap Vue
Vue.use(BootstrapVue)

// vue-select
Vue.component('v-select', vSelect)

// Custom components
Vue.component('c-switch', Switch)
Vue.component('flatpickr', Flatpickr)
Vue.component('ckeditor', CKEditor)
Vue.component('datatable', DataTable)

let router = Router(settings.adminHomePath, i18n)

router.beforeEach((to, from, next) => {
  document.title = `${to.meta.title} | ${settings.appName}`
  next()
})

Vue.prototype.$app = settings

// Register Ziggy route function
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
