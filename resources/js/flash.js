let Flashes = {};

Flashes.message = {
    SOMETHING_WENT_WRONG: "We're sorry! The server encountered an internal error."
};

Flashes.config = {
    duration: 10000
};

Flashes.add = function (message) {
    let flash = $('<div class="flash danger">' + message + '</div>');

    $('.flashes').append(flash);

    this.show(flash);
};

Flashes.show = function (flash) {
    let self = this;
    let btn = $('<a href="#" class="remove">X</a>');

    flash.append(btn);

    btn.on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();

        self.remove(flash);
    });

    setTimeout(function () {
        self.remove(flash);
    }, self.config.duration);

    flash.show();
};

Flashes.remove = function (flash) {
    flash.remove();
};

(function ($) {
    $.nette.ext('flashes', {
        init: function () {
            this.ext('snippets', true).after($.proxy(function ($el) {
                if (!$el.is('.flashes')) {
                    return;
                }

                $el.find('.flash').each(function () {
                    Flashes.show($(this));
                });
            }, this));
        }
    });
})(jQuery);

export default Flashes;
