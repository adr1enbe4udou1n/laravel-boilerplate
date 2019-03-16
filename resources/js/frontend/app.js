import 'babel-polyfill'
import loadClientScripts from './load-client-scripts'

// Vue & axios
import Vue from 'vue'
import { axios } from '../axios-config'

import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm'

import { createLocales } from '../vue-i18n-config'

window.axios = axios

// Bootstrap Vue
Vue.use(BootstrapVue)

export function createApp() {
  const i18n = createLocales(window.locale)

  const app = new Vue({
    i18n
  })

  return { app }
}

// Load Client Scripts
loadClientScripts(createApp)
