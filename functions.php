<?php

// if the config.json file is somewhere other than in the root of the theme, define BASSET_CONFIG_PATH with the path including the filename before including the theme_config_lib index file.

require_once 'includes/required_plugins/index.php'; // Require Plugins using TGM library
require_once 'includes/updater/index.php'; // WP-Updates.com updates
require_once 'includes/less/index.php'; // Less Compiler
require_once 'includes/theme_config_lib/index.php'; // Read theme config files
require_once 'includes/acf/index.php'; // Extend Advanced Custom Fields Plugin
require_once 'includes/components/index.php'; // Shortcodes
require_once 'includes/templates/index.php'; // Template script/style enqueue library


// Disable Theme & Plugin Editors - Child themes can re-enable it by setting this constant to false
if (!defined('DISALLOW_FILE_EDIT')) {
	define( 'DISALLOW_FILE_EDIT', true );
}

add_action('wp_enqueue_scripts', function() {
	wp_register_style('basset-layouts', get_template_directory_uri() . '/libraries/layout.less', array('open-sans'));
	// Stylesheet gets enqueued by templates
});

add_action('after_setup_theme', function() {
	add_theme_support('title-tag'); // Support <title> by default
});
add_action('admin_init', function() {
	add_editor_style('libraries/editor.less');
});

/* Safety Wrapper Function for get_field() */
function basset_get($key, $type_handle = '', $default_value = '') {
	if (function_exists('get_field')) {
		return get_field($key, $handle);
	} else {
		// ASSUMES POST META or OPTION - @todo: add support for user, comment, etc... Match ACF signature
		if ($type_handle == 'option' || $type_handle == 'options') {
			return get_option($key, $default);
		} else {
			global $post;
			return get_post_meta($post->ID, $key);
		}
	}
}
?>
