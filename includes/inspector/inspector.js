$ = jQuery.noConflict();
$(document).ready(function() {

    // TEMP: Show inspect
    //$("body").addClass('show_basset_inspector');

    // Toggle show inspector
    $("#wp-admin-bar-basset_inspector").on('click', function() {
        $("body").toggleClass('show_basset_inspector');
        // @TODO: Update user meta with state
    });

    $('.toggle-list li a').on('click', function() {
        console.log('click toggle list');

        $(this).next('ul').slideToggle(200);
    });

    basset = {};
    basset.inspector = {};
    basset.inspector.panels = [];

    $('[data-display-inspector-panel]').on('click', function() {
        var id = $(this).data('display-inspector-panel');
        push_inspector_panel(id);
    });
    $('[data-pop-inspector-panel]').on('click', function() {
        pop_inspector_panel();
    });
});

function push_inspector_panel(new_panel_id) {

    console.log("Push Panel:", new_panel_id);

    var active_panel = $('.inspector-panel.active');
    active_panel.removeClass('active').addClass('stacked');
    basset.inspector.panels.push(active_panel);

    var next_panel = $("#" + new_panel_id);
    next_panel.removeClass('staged').addClass('active');

    var new_width = next_panel.data('panel-width');
    if (new_width) {
        console.log('change width to', new_width);
        $('#basset_theme_inspector').css('width', new_width);
    }
}

function pop_inspector_panel() {

    console.log("Pop Panel");

    var active_panel = $('.inspector-panel.active');
    active_panel.removeClass('active').addClass('staged');

    var last_panel = basset.inspector.panels.pop();
    console.log('last panel', last_panel);
    last_panel.removeClass('stacked').addClass('active');

    var new_width = last_panel.data('panel-width');
    if (new_width) {
        console.log('change width to', new_width);
        $('#basset_theme_inspector').css('width', new_width);
    } else {
        $('#basset_theme_inspector').css('width', "");
    }
}
