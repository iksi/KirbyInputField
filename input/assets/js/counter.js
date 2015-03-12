(function ($) {
    'use strict';
    $.fn.counter = function () {
        return this.each(function () {
            var counter = $(this),
                field = $('[name="' + counter.data('count') + '"]'),
                length = field.val().length,
                max = field.data('max'),
                min = field.data('min');
            field.keyup(function () {
                length = field.val().length;
                counter.text(length + (max ? '/' + max : ''));
                if ((max && length > max) || (min && length < min)) {
                    counter.addClass('outside-range');
                } else {
                    counter.removeClass('outside-range');
                }
            });
        });
    };
}(jQuery));