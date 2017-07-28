/**
 * Initialize Vue
 */
import Vue from 'vue';

/**
 * Locales
 */
import VueI18n from 'vue-i18n';
import Locales from './vue-i18n-locales.generated.js';

Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: window.locale,
    messages: Locales
});

/**
 * Vee Validate
 */
import VeeValidate from 'vee-validate';
import french from 'vee-validate/dist/locale/fr';

VeeValidate.Validator.addLocale(french);

Vue.use(VeeValidate, {
    locale: window.locale
});

VeeValidate.Validator.extend('phone', (value, [inputId]) => {
    return $(`#${inputId}`).intlTelInput('isValidNumber');
});

// Components
import Panel from './components/Panel.vue';
Vue.component('panel', Panel);

// Bootstrap
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

import FormToggle from './components/FormToggle.vue';
Vue.component('b-form-toggle', FormToggle);

new Vue({
    i18n,
    data: {
        iconUser: '<i class="icon-user"></i>',
        iconEnvelope: '<i class="icon-envelope"></i>',
        iconLock: '<i class="icon-lock"></i>',
        iconCalendar: '<i class="icon-calendar"></i>'
    }
}).$mount('#app');
