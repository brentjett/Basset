<?php
/*
Basset Theme Inspector library

This library specifies an "Inspect Theme" Admin Bar item that triggers a dialog to see various parts of the current theme.
*/

// Add inspector libraries
add_action('wp_enqueue_scripts', function() {
    if (can_inspect()) {
        wp_enqueue_style('basset-inspector', get_template_directory_uri() . '/includes/inspector/inspector.less', array('open-sans', 'dashicons'));
        wp_enqueue_script('basset-inspector', get_template_directory_uri() . '/includes/inspector/inspector.js', array('jquery'), false, true);
    }
}, 20);

// "Inspect Theme" Admin Bar Item - Triggers the inspector panel to show
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

// Test if a user should see the inspector
function can_inspect() {
    if (is_user_logged_in() && current_user_can('install_themes')) return true;
    return false;
}

// Setup custom error handler
function basset_error_handler($number, $message, $file, $line_number, $context = array()) {
    global $basset;

    $types = array();
    $types[1] = "Error";
    $types[2] = "Warning";
    $types[4] = "Parse";
    $types[8] = "Notice";

    $icons = array();
    $icons[1] = '<span class="dashicons dashicons-dismiss"></span>';
    $icons[2] = '<span class="dashicons dashicons-dismiss"></span>';
    $icons[4] = '<span class="dashicons dashicons-dismiss"></span>';
    $icons[8] = '<span class="dashicons dashicons-info"></span>';

    $error = array(
        'number' => $number,
        'type' => $types[$number],
        'icon' => $icons[$number],
        'message' => $message,
        'file' => $file,
        'line_number' => $line_number,
        'context' => $context
    );

    $basset->errors[] = $error;

    return true; // True tells PHP not to run internal handler
}
set_error_handler('basset_error_handler');

// Print inspector DOM in wp_footer
add_action('wp_footer', function() {

    if (can_inspect()) {
        ?>
        <div id="basset_theme_inspector">
            <?php
            require_once 'panels/main.php';
            require_once 'panels/errors.php';
            require_once 'panels/nav.php';
            require_once 'panels/basset-object.php';
            do_action('basset/inspector/panels');
            ?>
        </div><!-- / #basset_theme_inspector -->
        <?php
    }
});

function basset_print_property_list($id, $object) {
    if (isset($object)) {
        $level = 0;
        ?>
        <table id="<?=$id?>" class="property_list">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Type</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($object as $property => $value) {
                    basset_print_property_list_row($property, $value, $id, $level, $id);
                }
                ?>
            </tbody>
        </table><!-- /.property_list -->
        <?php
    }
}

function basset_print_property_list_row($property, $value, $parent = '', $level = 0, $table_id = '') {
    if (is_array($value) || is_object($value)) {
        $is_collection = true;
        $has_children = "true"; // for data- attr.
        $icon = "dashicons-arrow-right";
    } else {
        $is_collection = false;
        $has_children = "false"; // for data- attr.
        $icon = "";
    }
    if (isset($parent)) {
        $parent = "data-parent='$table_id-$parent'";
    }
    ?>
    <tr id="<?= $table_id . '-' . $property ?>" class="property-summary-row" <?=$parent?> data-level="<?=$level?>" data-is-collection="<?=$has_children?>">
        <? if (is_int($property)) { $property = "Item: $property"; } ?>
        <td class="basset-property-list-key"><span class="dashicons <?=$icon?>"></span> <?php print $property ?></td>
        <td class="basset-property-list-type"><?php print gettype($value) ?></td>
        <td class="basset-property-list-value"><?php print basset_property_summary($value) ?></td>
    </tr>
    <?
    if ($is_collection && count($value)) {
        $parent = $property;
        $level++;
        foreach($value as $property => $value) {
            basset_print_property_list_row($property, $value, $parent, $level, $table_id);
        }
    }
}

function basset_property_summary($value) {
    $type = gettype($value);
    switch ($type) {
        case "boolean":
            if ($value) {
                $checked = 'checked="checked"';
            } else {
                $checked = false;
            }
            return "<input type='checkbox' $checked>";
        case "integer":
            return "Number (int)";
        case "double":
            return "Number (double)";
        case "string":
            // @TODO: Check value length - send back short strings or truncate.
            return $value;
        case "array":
            return count($value) . " Items";
        case "object":
            return "{...}";
        case "resource":
            return "Resource";
        case "NULL":
            return "null";
        default:
            return "Unknown";
    }
}
?>
