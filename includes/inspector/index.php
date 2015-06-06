<?php
/*
Basset Theme Inspector library

This library specifies an "Inspect Theme" Admin Bar item that triggers a dialog to see various parts of the current theme.
*/

add_action('wp_enqueue_scripts', function() {
    if (can_inspect()) {

        wp_enqueue_style('basset-inspector', get_template_directory_uri() . '/includes/inspector/inspector.less', array('open-sans', 'dashicons'));
        wp_enqueue_script('basset-inspector', get_template_directory_uri() . '/includes/inspector/inspector.js', array('jquery'), false, true);
    }
}, 20);

add_action( 'wp_before_admin_bar_render', function() {
	global $wp_admin_bar;
    if (can_inspect()) {
        $args = array(
            'id' => 'basset_inspector',
            'title' => __( 'Inspect Theme', 'basset' ),
            'href' => '#',
            'meta'   => array(),
        );
        $wp_admin_bar->add_menu( $args );
    }
});

function basset_error_handler($number, $message, $file, $line_number, $context = array()) {
    global $basset;

    $types = array();
    $types[1] = "Error";
    $types[2] = "Warning";
    $types[4] = "Parse";
    $types[8] = "Notice";

    $error = array(
        'number' => $number,
        'type' => $types[$number],
        'message' => $message,
        'file' => $file,
        'line_number' => $line_number,
        'context' => $context
    );

    $basset->errors[] = $error;

    return true; // True tells PHP not to run internal handler
}
set_error_handler('basset_error_handler');

add_action('wp_footer', function() {

    if (can_inspect()) {
        ?>
        <div id="basset_theme_inspector">

            <?php
            require_once 'panels/main.php';
            require_once 'panels/errors.php';
            require_once 'panels/nav.php';
            ?>

        </div>
        <?php
    }
});

function can_inspect() {
    if (is_user_logged_in() && current_user_can('install_themes')) return true;
    return false;
}

?>
