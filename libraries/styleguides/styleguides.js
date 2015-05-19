$ = jQuery.noConflict();
$(document).ready(function() {

    $("input[type=checkbox]").on('click', function() {
        var handle = $(this).val();
        var stylesheet = $('link#' + handle + '-css');

        if ($(this).is(':checked')) {
            stylesheet.attr('disabled', false);
        } else {
            stylesheet.attr('disabled', 'disabled');
        }

    });

});
