import NProgress from "nprogress/nprogress";
import "nprogress/nprogress.css";

/**
 * Integration of NProgress.js into nette.ajax.js
 * For documentation see:
 *  - https://github.com/rstacruz/nprogress
 *  - https://addons.nette.org/vojtech-dobes/nette-ajax-js
 */
(function ($) {
    $.nette.ext('progress', {
        init: function () {
            NProgress.configure({minimum: 0.2, showSpinner: false});
        },
        start: function () {
            NProgress.start();
        },
        success: function () {
            NProgress.done();
        },
        error: function () {
            NProgress.done();
        }
    });
})(jQuery);