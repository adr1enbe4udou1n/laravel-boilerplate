
import './../bootstrap';

import jszip from 'jszip';
window.JSZip = jszip;

// Datatables
import 'datatables.net';
import 'datatables.net-bs4';
import 'datatables.net-select';
import 'datatables.net-buttons';
import 'datatables.net-buttons-bs4';
import 'datatables.net-responsive';
import 'datatables.net-responsive-bs4';
import 'datatables.net-buttons/js/buttons.html5';

// Plugins
import './../plugins';

/**
 * Vue
 */
import Vue from 'vue';
import VueI18n from '../vue-i18n';
const i18n = VueI18n(window.locale);

// VeeValidate
import VeeValidate from '../vee-validate';
VeeValidate(window.locale);

// vue-select
import vSelect from 'vue-select';
Vue.component('v-select', vSelect);

// Custom components
import FormFieldset from '.././components/FormFieldset.vue';
Vue.component('b-form-fieldset', FormFieldset);

import InputGroup from '.././components/InputGroup.vue';
Vue.component('b-input-group', InputGroup);

import FormCheckbox from '.././components/FormCheckbox.vue';
Vue.component('b-form-checkbox', FormCheckbox);

import FormRadio from '.././components/FormRadio.vue';
Vue.component('b-form-radio', FormRadio);

import FormToggle from '.././components/FormToggle.vue';
Vue.component('b-form-toggle', FormToggle);

import Flatpickr from '.././components/Flatpickr.vue';
Vue.component('flatpickr', Flatpickr);

import CKEditor from '.././components/CKEditor.vue';
Vue.component('ckeditor', CKEditor);

import BatchAction from './components/BatchAction.vue';
Vue.component('batch-action', BatchAction);

// CoreUI
import App from './App.vue';
import Router from './router';

let router = Router(i18n);

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} | ${window.settings.appName}`;
    next();
});

Vue.prototype.$app = window.settings;
Vue.prototype.$app.route = window.route;

// Init
if (document.getElementById('app') !== null) {
    new Vue({
        i18n,
        router,
        template: '<App/>',
        components: {App},
    }).$mount('#app');
}
