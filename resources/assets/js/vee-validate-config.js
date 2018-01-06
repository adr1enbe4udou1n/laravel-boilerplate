
/**
 * Initialize Vue
 */
import Vue from 'vue'

/**
 * Vee Validate
 */
import VeeValidate from 'vee-validate'
import french from 'vee-validate/dist/locale/fr'

VeeValidate.Validator.localize('fr', french)

VeeValidate.Validator.extend('phone', (value, [inputId]) => {
  return $(`#${inputId}`).intlTelInput('isValidNumber')
})

export function createValidator (locale) {
  Vue.use(VeeValidate, {
    locale: locale,
    fieldsBagName: 'formFields'
  })
}
