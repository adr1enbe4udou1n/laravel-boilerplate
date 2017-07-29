
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

export const i18n = new VueI18n({
    locale: window.locale,
    messages: Locales
});
