import './load-client-scripts'

// Vue & axios
import Vue from 'vue'
import { axios } from '../axios-config'

import VeeValidate from '../vee-validate'
import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm'

import { createLocales } from '../vue-i18n'

window.axios = axios

/**
 * Vue Init
 */
VeeValidate(window.locale)

// Bootstrap Vue
Vue.use(BootstrapVue)

export function createApp () {
  const i18n = createLocales(window.locale)

  const app = new Vue({
    i18n
  })

  return { app }
}

// Init App
const { app } = createApp()
app.$mount('#app')
