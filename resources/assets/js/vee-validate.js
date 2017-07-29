
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
    locale: window.locale
});

VeeValidate.Validator.extend('phone', (value, [inputId]) => {
    return $(`#${inputId}`).intlTelInput('isValidNumber');
});
