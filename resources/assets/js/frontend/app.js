require('./../bootstrap');
require('./../plugins');
require('cookieconsent');
require('slick-carousel');

/**
 * Initialize Vue
 */
import Vue from 'vue';
import VueI18n from '../vue-i18n';
const i18n = VueI18n(window.locale);

// VeeValidate
import VeeValidate from '../vee-validate';
VeeValidate(window.locale);

// Components
import Panel from '../components/Panel.vue';
Vue.component('panel', Panel);

// Init
new Vue({
    i18n
}).$mount('#app');

/**
 * Font
 */
const WebFont = require('webfontloader');

WebFont.load({
    google: {
        families: ['Roboto']
    }
});

(function ($) {
    /**
     * Slick
     */
    $('.slider').removeClass('hidden').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1
    });

    /**
     * Cookie Consent
     */
    window.addEventListener('load', function () {
        window.cookieconsent.initialise({
            'palette': {
                'popup': {
                    'background': '#fff',
                    'text': '#777'
                },
                'button': {
                    'background': '#3097d1',
                    'text': '#ffffff'
                }
            },
            'showLink': false,
            'theme': 'edgeless',
            'content': {
                'message': window.settings.cookieconsent.message,
                'dismiss': window.settings.cookieconsent.dismiss
            }
        });
    });

    /**
     * Plugins to load after DOM is ready
     */
    $(function () {
        /**
         * Bind all bootstrap tooltips
         */
        $('[data-toggle="tooltip"]').tooltip();

        /**
         * Bind all bootstrap popovers
         */
        $('[data-toggle="popover"]').popover();

        /**
         * Bind all swal confirm buttons
         */
        $('[data-toggle="confirm"]').click(function (e) {
            e.preventDefault();

            $.confirmSwal(e.target, function () {
                $(e.target).closest('form').submit();
            });
        });

        $('[data-toggle="password-strength-meter"]').each(function () {
            $(this).pwstrength({
                ui: {
                    bootstrap4: true
                }
            });
        });

        $('[type="tel"]').intlTelInput({
            autoPlaceholder: 'aggressive',
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js',
            initialCountry: window.locale === 'en' ? 'us' : window.locale,
            preferredCountries: ['us', 'gb', 'fr']
        });

        /**
         * Bootstrap tabs nav specific hash manager
         */
        let hash = document.location.hash;
        let tabanchor = $('.nav-tabs a:first');

        if (hash) {
            tabanchor = $(`.nav-tabs a[href="${hash}"]`);
        }

        tabanchor.tab('show');

        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        });
    });
})(window.jQuery);
