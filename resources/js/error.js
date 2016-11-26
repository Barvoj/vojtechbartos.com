import Flashes from "./flash.js";

(function ($) {
    $.nette.ext('error', {
        error: function () {
            Flashes.add(Flashes.message.SOMETHING_WENT_WRONG);
        }
    });
})(jQuery);