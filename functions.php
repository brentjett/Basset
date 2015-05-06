<?php 

// if the config.json file is somewhere other than in the root of the theme, define BASSET_CONFIG_PATH with the path including the filename before including the theme_config_lib index file.

require_once 'includes/updater/index.php';
require_once 'includes/less/index.php';
require_once 'includes/theme_config_lib/index.php';
require_once 'includes/acf/index.php';
require_once 'includes/components/index.php';
require_once 'includes/templates/index.php';


//add_filter('less_force_compile', __return_true);

// Disable Theme & Plugin Editors - Child themes can re-enable it by setting this constant to false
if (!defined('DISALLOW_FILE_EDIT')) {
	define( 'DISALLOW_FILE_EDIT', true );
}

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('basset-layouts', get_template_directory_uri() . '/libraries/layout.less');
});

add_action('after_setup_theme', function() {
	register_nav_menu('basset-header', 'Header');
});

/* Safety Wrapper Function for get_field() */
function basset_get($key, $type_handle = '', $default_value = '') {
	if (function_exists('get_field')) {
		return get_field($key, $handle);
	} else {
		// ASSUMES POST META - @todo: add support for user, comment, etc... Match ACF signature
		if ($type_handle == 'option' || $type_handle == 'options') {
			return get_option($key, $default);
		} else {
			global $post;
			return get_post_meta($post->ID, $key);
		}
	}
}

function basset_nav_menu_fallback($args) {
	?>
	<div class="nav-menu-placeholder"><a href="/wp-admin/nav-menus.php">Assign Nav Menu to <?=$args['location']?></a></div>
	<?
}
?>