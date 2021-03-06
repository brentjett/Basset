<?php
/*
Basset Foundation Theme
*/

// Manager class to help store state for shared elements
require_once 'includes/Basset.class.php';
$basset = Basset::instance();

require_once 'includes/required_plugins/index.php'; // Require Plugins using TGM library
require_once 'includes/updater/index.php'; // WP-Updates.com updates
require_once 'includes/less/index.php'; // Less Compiler
require_once 'includes/config/index.php'; // Read theme config files
require_once 'includes/acf/index.php'; // Extend Advanced Custom Fields Plugin
require_once 'includes/components/index.php'; // Shortcodes
require_once 'includes/templates/index.php'; // Template script/style enqueue library
require_once 'includes/inspector/index.php'; // Theme Inspector UI

require_once 'includes/virtual_pages/index.php'; // Register styleguides and other static pages


// Disable Theme & Plugin Editors - Child themes can re-enable it by setting this constant to false
if (!defined('DISALLOW_FILE_EDIT')) {
	define( 'DISALLOW_FILE_EDIT', true );
}

add_action('wp_enqueue_scripts', function() {

	// Layout.less is registered and enqueued by templates
	wp_register_style('basset-layouts', get_template_directory_uri() . '/libraries/basset-layout.less', array('open-sans', 'dashicons'));

	// Content.less is enqueued in both the front side and the editor
	wp_enqueue_style('basset-content', get_template_directory_uri() . '/libraries/basset-content.less', array('open-sans', 'dashicons'));
	//wp_enqueue_script('basset-content', get_template_directory_uri() . '/libraries/basset-content.js', array('jquery'));
});

add_action('admin_init', function() {
	add_editor_style('libraries/basset-content.less');
});

add_action('after_setup_theme', function() {
	add_theme_support('title-tag'); // Support <title> by default

	$base_font = "'Open Sans', Helvetica, sans-serif";

	$defaults = array(
		'primary_color' => '#555555',
		'primary_text_color' => 'white',

		'secondary_color' => '#0792A0',
		'secondary_text_color' => 'white',

		'accent_color' => '#664E39',
		'accent_text_color' => '#F8C41C',

		'base_font' => $base_font,
		'base_font_size' => '18px',
		'base_line_height' => '1.5em',

		'display_font' => $base_font
	);
	$GLOBALS['basset_defaults'] = apply_filters('basset/defaults', $defaults);

	add_image_size('location-photo-square', 350, 350, true);
});

// Defaults get passed through theme_mods first to see if there is a replacement value
add_filter('less_vars', function($vars) {
	global $basset_defaults;
	if (!empty($basset_defaults)) {
		foreach($basset_defaults as $key => $val) {
			$vars[$key] = get_theme_mod($key, $val);
		}
	}
	return $vars;
});

/* Safety Wrapper Function for get_field() */
function basset_get($key, $type_handle = '', $default_value = '') {
	if (function_exists('get_field')) {
		return get_field($key, $handle);
	} else {
		if ($type_handle == 'option' || $type_handle == 'options') {
			return get_option($key, $default);
		} else {
			global $post;
			return get_post_meta($post->ID, $key);
		}
	}
}

function basset_get_default($key = '') {
	global $basset_defaults;
	if ($key && $basset_defaults[$key]) {
		$val = $basset_defaults[$key];
		return $val;
	}
}

// Converts an associative array into a style="" string
function basset_get_style_attr($styles = array()) {
	if (!empty($styles)) {
		$strings = array();
		foreach($styles as $property => $value) {
			$strings[] = "$property: $value";
		}
		$string = implode('; ', $strings);
		$string = "style='$string'";
		return $string;
	}
	return;
}
?>
