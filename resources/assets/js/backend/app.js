import './load-client-scripts'

// Vue & axios
import Vue from 'vue'
import '../axios-config'

import VeeValidate from '../vee-validate'
import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm'
import vSelect from 'vue-select'

// CoreUI components
import Switch from './components/Switch'

// Vendor plugins components
import DataTable from './components/plugins/DataTable'
import CKEditor from './components/plugins/CKEditor'
import Flatpickr from './components/plugins/Flatpickr'

import { createRouter } from './router'
import { createStore } from './store'
import { createLocales } from '../vue-i18n'

import App from './App.vue'

/**
 * JS Settings App
 */
let jsonSettings = $('[data-settings-selector="settings-json"]').text()
let settings = jsonSettings ? JSON.parse(jsonSettings) : {}

/**
 * Vue Init
 */
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

export function createApp () {
  // Init router and store
  const i18n = createLocales(settings.locale)
  const router = createRouter(settings.adminHomePath, i18n)
  const store = createStore(window.route)

  router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} | ${settings.appName}`
    next()
  })

  const app = new Vue({
    router,
    store,
    i18n,
    template: '<App/>',
    components: {App}
  })

  return { app, router, store }
}

// Init App
if (document.getElementById('app') !== null) {
  const { app } = createApp()
  app.$mount('#app')
}
