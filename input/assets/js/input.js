(function ($) {
    'use strict';
    $.fn.count = function () {
        return this.each(function () {
            // your code for each input
            var counter = $('[data-counter="' + this.name + '"]'),
                length = this.value.length,
                max = $(this).data('max'),
                min = $(this).data('min');
            $(this).keyup(function () {
                length = this.value.length;
                counter.text(length + '/' + max);
                if ((max !== undefined && length > max)
                        || (min !== undefined && length < min)) {
                    $(counter).addClass('outside-range');
                } else {
                    $(counter).removeClass('outside-range');
                }
            });
        });
    };
}(jQuery));