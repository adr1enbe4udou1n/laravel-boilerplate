import loadClientScripts from './load-client-scripts'

// Vue & axios
import Vue from 'vue'
import { axios } from '../axios-config'

import BootstrapVue from 'bootstrap-vue'

import { createLocales } from '../vue-i18n-config'
import { createValidator } from '../vee-validate-config'

window.axios = axios

// Bootstrap Vue
Vue.use(BootstrapVue)

export function createApp () {
  const i18n = createLocales(window.locale)
  createValidator(window.locale)

  const app = new Vue({
    i18n
  })

  return { app }
}

// Load Client Scripts
loadClientScripts(createApp)
