import './load-client-scripts'

// Vue & axios
import Vue from 'vue'
import '../axios-config'

import VeeValidate from '../vee-validate'
import BootstrapVue from 'bootstrap-vue'
import vSelect from 'vue-select'

// CoreUI components
import Switch from './components/Switch'

// Vendor plugins components
import DataTable from './components/plugins/DataTable'
import RichTextEditor from './components/plugins/RichTextEditor'
import DateTimePicker from './components/plugins/DateTimePicker'

import { createRouter } from './router'
import { createStore } from './store'
import { createLocales } from '../vue-i18n'

import App from './App.vue'
import Noty from 'noty'

/**
 * Vue Init
 */
VeeValidate(window.settings.locale)

// Bootstrap Vue
Vue.use(BootstrapVue)

// vue-select
Vue.component('v-select', vSelect)

// Custom components
Vue.component('c-switch', Switch)
Vue.component('p-datetimepicker', DateTimePicker)
Vue.component('p-richtexteditor', RichTextEditor)
Vue.component('b-datatable', DataTable)

Vue.prototype.$app = window.settings

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

let noty = (type, text) => {
  new Noty({
    layout: 'topRight',
    theme: 'bootstrap-v4',
    timeout: 2000,
    text,
    type
  }).show()
}

Vue.prototype.$app.alert = (text) => {
  noty('alert', text)
}

Vue.prototype.$app.success = (text) => {
  noty('success', text)
}

Vue.prototype.$app.error = (text) => {
  noty('error', text)
}

Vue.prototype.$app.warning = (text) => {
  noty('warning', text)
}

Vue.prototype.$app.info = (text) => {
  noty('info', text)
}

export function createApp () {
  // Init router and store
  const i18n = createLocales(window.settings.locale)
  const router = createRouter(window.settings.adminHomePath, i18n)
  const store = createStore(window.route)

  router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} | ${window.settings.appName}`
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
