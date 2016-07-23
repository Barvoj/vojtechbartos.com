(function ($) {
    $.nette.ext('bs-modal', {
        init: function () {
            var self = this;

            this.ext('snippets', true).before($.proxy(function ($el) {
                $el = $($el).find('> div');
                if ($el.length == 0 || !$el.is('.modal')) {
                    return;
                }

                self.before();
            }, this));

            this.ext('snippets', true).after($.proxy(function ($el) {
                $el = $($el).find('> div');
                if ($el.length == 0 || !$el.is('.modal')) {
                    return;
                }

                self.after($el);
            }, this));

            $('[id^="snippet-"] > .modal').each(function () {
                self.after($(this));
            });
        }
    }, {
        before: function () {
            var $opened = this.getOpened();

            if (!$opened) {
                return;
            }

            this.hide($opened);
        },
        after: function ($modal) {
            if (this.isEmpty($modal)) {
                return; // ignore empty modal
            }
            $modal.removeAttr('style');

            this.show($modal);
        },
        isEmpty: function (el) {
            var content = el.find('.modal-content');
            return !content.length;
        },
        getOpened: function () {
            var $opened = $('.modal.in');

            if ($opened.length) {
                $opened = $opened.first();
            } else {
                $opened = null;
            }

            return $opened;
        },
        hide: function ($modal) {
            $modal.modal('hide');
        },
        show: function ($modal) {
            $modal.modal('show');
        }
    });
})(jQuery);