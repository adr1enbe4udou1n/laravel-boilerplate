
require('./../bootstrap');

window.JSZip = require('jszip');

// Datatables
require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-select');
require('datatables.net-buttons');
require('datatables.net-buttons-bs4');
require('datatables.net-responsive');
require('datatables.net-responsive-bs4');
require('datatables.net-buttons/js/buttons.html5');

// Plugins
require('./../plugins');

/**
 * Vue
 */
import Vue from 'vue';
import VueI18n from '../vue-i18n';
const i18n = VueI18n(window.locale);

// VeeValidate
import VeeValidate from '../vee-validate';
VeeValidate(window.locale);

// Bootstrap components
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

import vSelect from 'vue-select';
Vue.component('v-select', vSelect);

// Custom components
import FormToggle from '.././components/FormToggle.vue';
Vue.component('b-form-toggle', FormToggle);

import InputFile from '.././components/InputFile.vue';
Vue.component('b-input-file', InputFile);

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
    document.title = `${to.meta.title} | ${window.settings.app.name}`;
    next();
});

// Init
new Vue({
    i18n,
    router,
    template: '<App/>',
    components: { App },
    data: {
        user: window.settings.user,
        isImpersonation: window.settings.is_impersonation,
        usurperName: window.settings.usurper_name,
        adminPath: window.settings.app['admin_path'],
        locales: window.settings.locales,
        blogEnabled: window.settings.blog.enabled,
        appName: window.settings.app.name,
        editorName: window.settings.app.editor_name,
        editorSiteUrl: window.settings.app.editor_site_url
    },
}).$mount('#app');
