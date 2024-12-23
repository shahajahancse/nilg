/*A jQuery plugin which add loading indicators into buttons
 * By Minoli Perera
 * MIT Licensed.
 */
(function ($) {
    $('.has-spinner').attr("disabled", false);
    $.fn.buttonLoader = function (action) {
        var self = $(this);
        if (action == 'start') {
            if ($(self).attr("disabled") == "disabled") {
                // console.log('Already disabled');
                return false;
            }
            // console.log('Make disabled');
            $('.has-spinner').attr("disabled", true);
            $(self).attr('data-btn-text', $(self).text());
            var text = 'Processing...';
            // console.log($(self).attr('data-load-text'));
            if ($(self).attr('data-load-text') != undefined && $(self).attr('data-load-text') != "") {
                text = $(self).attr('data-load-text');
            }
            $(self).html('<span class="spinner"><i class="fa fa-spinner fa-spin" title="button-loader"></i></span> ' + text);
            $(self).addClass('active');
        }
        if (action == 'stop') {
            // console.log('Regain');
            $(self).html($(self).attr('data-btn-text'));
            $(self).removeClass('active');
            $('.has-spinner').attr("disabled", false);
        }
    };
})(jQuery);
