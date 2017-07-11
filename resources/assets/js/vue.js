/**
 * Initialize Vue
 */
import Vue from 'vue';

/**
 * Vee Validate
 */
import VeeValidate from 'vee-validate';
import french from 'vee-validate/dist/locale/fr';

VeeValidate.Validator.addLocale(french);

Vue.use(VeeValidate, {
    locale: locale
});

VeeValidate.Validator.extend('phone', (value, [inputId]) => {
    return $(`#${inputId}`).intlTelInput('isValidNumber');
});

// Components
import Panel from './components/Panel.vue';
Vue.component('panel', Panel);
const app = new Vue({
    el: '#app'
});
