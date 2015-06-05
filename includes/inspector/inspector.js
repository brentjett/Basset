$ = jQuery.noConflict();
$(document).ready(function() {

    // Toggle show inspector
    $("#wp-admin-bar-basset_inspector").on('click', function() {
        $("body").toggleClass('show_basset_inspector');
        // @TODO: Update user meta with state
    });

    $('.toggle-list li a').on('click', function() {
        console.log('click toggle list');

        $(this).next('ul').slideToggle(200);
    });
});
