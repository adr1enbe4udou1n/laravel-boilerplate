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

export function createApp () {
  // Init router and store
  const i18n = createLocales(window.settings.locale)
  const router = createRouter(window.settings.adminHomePath, i18n)
  const store = createStore(window.route)

  /**
   * Server-side settings
   */
  Vue.prototype.$app = window.settings

  /**
   * Server-side named routes function router
   */
  Vue.prototype.$app.route = window.route

  /**
   * Client-side permissions
   */
  if (Vue.prototype.$app.user) {
    Vue.prototype.$app.user.can = (permission) => {
      if (Vue.prototype.$app.user.id === 1 ||
        Vue.prototype.$app.permissions.includes('access all backend')) {
        return true
      }
      return Vue.prototype.$app.permissions.includes(permission)
    }
  }

  /**
   * Notifications
   */
  let noty = (type, text) => {
    new Noty({
      layout: 'topRight',
      theme: 'bootstrap-v4',
      timeout: 2000,
      text,
      type
    }).show()
  }

  Vue.prototype.$app.noty = {
    alert: (text) => {
      noty('alert', text)
    },
    success: (text) => {
      noty('success', text)
    },
    error: (text) => {
      noty('error', text)
    },
    warning: (text) => {
      noty('warning', text)
    },
    info: (text) => {
      noty('info', text)
    }
  }

  Vue.prototype.$app.error = (error) => {
    // Not allowed error
    if (error.response.status === 403) {
      noty('error', i18n.t('exceptions.unauthorized'))
      return
    }

    // Domain error
    if (error.response.data.error !== undefined) {
      noty('error', error.response.data.message)
      return
    }

    // Generic error
    noty('error', i18n.t('exceptions.general'))
  }

  router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} | ${window.settings.appName}`
    next()
  })

  const app = new Vue({
    router,
    store,
    i18n,
    components: {App},
    template: '<App/>'
  })

  return {app, router, store}
}

// Init App
if (document.getElementById('app') !== null) {
  const {app} = createApp()
  app.$mount('#app')
}
