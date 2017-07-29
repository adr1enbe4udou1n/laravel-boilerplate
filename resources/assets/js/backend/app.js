
require('./../bootstrap');
require('./../../vendor/coreui/js/app');

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
require('./../vee-validate');
const i18n = require('./../vue-i18n');

// Bootstrap components
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

// Custom components
import FormToggle from '.././components/FormToggle.vue';
Vue.component('b-form-toggle', FormToggle);

// CoreUI
import App from './App.vue';
import router from './router';

// Init
new Vue({
    router,
    i18n,
    template: '<App/>',
    components: { App },
    data: {
        iconUser: '<i class="icon-user"></i>',
        iconEnvelope: '<i class="icon-envelope"></i>',
        iconLock: '<i class="icon-lock"></i>',
        iconCalendar: '<i class="icon-calendar"></i>'
    },
}).$mount('#app');
