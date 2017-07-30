
require('./../bootstrap');

window.JSZip = require('jszip');

// Datatables
require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-select');
require('datatables.net-buttons');
require('datatables.net-buttons-bs4');
require('datatables.net-buttons/js/buttons.html5');

//CKEditor
require('ckeditor');
require('ckeditor/adapters/jquery');

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

// Custom components
import FormToggle from '.././components/FormToggle.vue';
Vue.component('b-form-toggle', FormToggle);

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
        settings: window.settings,
        iconUser: '<i class="icon-user"></i>',
        iconEnvelope: '<i class="icon-envelope"></i>',
        iconLock: '<i class="icon-lock"></i>',
        iconCalendar: '<i class="icon-calendar"></i>'
    },
}).$mount('#app');
