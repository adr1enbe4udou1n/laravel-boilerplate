
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

export default locale => {
  Vue.use(VeeValidate, {
    locale: locale,
    fieldsBagName: 'formFields'
  })

  VeeValidate.Validator.extend('phone', (value, [inputId]) => {
    return $(`#${inputId}`).intlTelInput('isValidNumber')
  })
}
